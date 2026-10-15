#!/bin/sh

set -eu

PORT="${PORT:-10000}"

echo "Starting PortfolioCraft on port ${PORT}..."

# Configure Apache to listen on Render's assigned port.
sed -i "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf

sed -i \
    "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" \
    /etc/apache2/sites-available/000-default.conf

# Clear stale Laravel configuration.
php artisan config:clear

# Ensure Laravel storage directories are writable.
chown -R www-data:www-data storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache

# Apply any pending database migrations.
php artisan migrate --force

# Start Apache in the foreground.
exec apache2-foreground
