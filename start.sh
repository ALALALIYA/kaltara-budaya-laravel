#!/bin/sh

echo "======================================"
echo " KALTARA BUDAYA - Railway Startup"
echo "======================================"

echo ""
echo "==> [1/4] Running database migrations..."
php artisan migrate --force
if [ $? -ne 0 ]; then
  echo "!!! Migration failed! Trying to continue..."
fi

echo ""
echo "==> [2/4] Seeding database with initial data..."
php artisan db:seed --force
if [ $? -ne 0 ]; then
  echo "!!! Seeding failed!"
fi

echo ""
echo "==> [3/4] Creating storage symlink..."
php artisan storage:link --force 2>/dev/null || true

echo ""
echo "==> [4/4] Caching config, routes, views..."
php artisan config:cache || true
php artisan route:cache  || true
php artisan view:cache   || true

echo ""
echo "==> Starting app on 0.0.0.0:${PORT:-8000}"
echo "======================================"
exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
