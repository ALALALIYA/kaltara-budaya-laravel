<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Drop the questionnaire_responses table.
     * The SUS questionnaire feature has been removed from the application;
     * data is now collected via Google Form.
     */
    public function up(): void
    {
        Schema::dropIfExists('questionnaire_responses');
    }

    /**
     * Reverse the migration (table is not recreated — data was intentionally dropped).
     */
    public function down(): void
    {
        // Intentionally left empty. Restoring the table and its data
        // is out of scope; use a database backup if needed.
    }
};
