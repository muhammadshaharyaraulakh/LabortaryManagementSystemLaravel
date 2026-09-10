#!/usr/bin/env bash
set -e

echo "==> Preparing storage and directories..."
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p public/ProfileImages
mkdir -p public/Signatures
if [ ! -e public/storage ]; then
    php artisan storage:link || true
fi

echo "==> Clearing cache..."
php artisan config:clear
php artisan view:clear
php artisan route:clear

echo "==> Running database migrations..."
php artisan migrate --force

echo "==> Checking if initial database seeding is needed..."
USER_COUNT=$(php artisan tinker --execute="echo App\Models\User::count();")
if [ "$USER_COUNT" = "0" ]; then
    echo "Seeding initial database data..."
    php artisan db:seed --force
    echo "Database seeded successfully!"
else
    echo "Database already seeded. Skipping."
fi

echo "==> Starting application server on port ${PORT:-8080}..."
exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"