#!/bin/sh
set -e

echo "==> Running migrations..."
php artisan migrate --force

echo "==> Seeding database..."
php artisan db:seed --force

echo "==> Creating storage symlink..."
php artisan storage:link --force 2>/dev/null || true

echo "==> Starting server on port ${PORT:-8000}..."
exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
