<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Material extends Model
{
    const STATUS_DRAFT    = 'draft';
    const STATUS_PENDING  = 'pending';
    const STATUS_APPROVED = 'approved';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'kompetensi_dasar',
        'pertemuan_ke',
        'content',
        'image',
        'video_url',
        'audio_url',
        'category',
        'teacher_id',
        'status',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Material $material) {
            if (empty($material->slug)) {
                $base = Str::slug($material->title);
                $slug = $base;
                $i = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = "{$base}-{$i}";
                    $i++;
                }
                $material->slug = $slug;
            }
        });
    }

    // ─── Scopes ───────────────────────────────────────────────────────

    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    // ─── Relationships ────────────────────────────────────────────────

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(MaterialProgress::class);
    }

    public function completedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'material_progress')
            ->withPivot('completed_at')
            ->withTimestamps();
    }

    // ─── Accessors ────────────────────────────────────────────────────

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'dayak'  => 'Suku Dayak',
            'banjar' => 'Suku Banjar',
            'kutai'  => 'Suku Kutai',
            'tidung' => 'Suku Tidung',
            default  => $this->category ? ucfirst($this->category) : 'Umum',
        };
    }

    public function getCategoryColorAttribute(): string
    {
        return match ($this->category) {
            'dayak'  => 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300',
            'banjar' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300',
            'kutai'  => 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300',
            'tidung' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300',
            default  => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
        };
    }

    public function getCategoryIconAttribute(): string
    {
        return match ($this->category) {
            'dayak'  => '🦅',
            'banjar' => '🎋',
            'kutai'  => '🐉',
            'tidung' => '🌊',
            default  => '📚',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'draft'    => 'Draft',
            'pending'  => 'Menunggu Persetujuan',
            'approved' => 'Disetujui',
            default    => ucfirst($this->status),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'draft'    => 'bg-gray-100 text-gray-700',
            'pending'  => 'bg-yellow-100 text-yellow-800',
            'approved' => 'bg-green-100 text-green-800',
            default    => 'bg-gray-100 text-gray-700',
        };
    }

    public function getEmbedVideoUrlAttribute(): ?string
    {
        if (!$this->video_url) {
            return null;
        }

        $url = trim($this->video_url);
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|embed|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i';

        if (preg_match($pattern, $url, $matches)) {
            $videoId = $matches[1];
            return "https://www.youtube.com/embed/{$videoId}";
        }

        return $url;
    }
}
