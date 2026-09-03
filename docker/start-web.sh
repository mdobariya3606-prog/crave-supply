#!/bin/sh
set -eu

port="${PORT:-10000}"

# Render's PORT is supplied at runtime; Apache must listen on that port.
sed -ri "s/^Listen [0-9]+/Listen ${port}/" /etc/apache2/ports.conf
sed -ri "s/:([0-9]+)>/:${port}>/" /etc/apache2/sites-available/000-default.conf

# Migrations are additive and run once when the web service starts.
php artisan migrate --force
php artisan storage:link || true
php artisan optimize

exec apache2-foreground
