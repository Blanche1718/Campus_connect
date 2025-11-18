#!/bin/sh

# Arrêter le script en cas d'erreur
set -e

# Lancer les migrations
echo "--- Running database migrations ---"
php artisan migrate --force

# Lancer Supervisor (qui gère Nginx et PHP-FPM)
echo "--- Starting application ---"
exec /usr/bin/supervisord -c /etc/supervisord.conf
