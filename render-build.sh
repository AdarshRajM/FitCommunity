#!/usr/bin/env bash
# exit on error
set -o errexit

echo "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

echo "Installing Node.js dependencies..."
npm install

echo "Building frontend assets..."
npm run build

echo "Clearing and caching Laravel configuration..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache

echo "Running Database Migrations..."
php artisan migrate --force

echo "Creating storage link..."
php artisan storage:link || true

echo "Build script completed successfully!"
