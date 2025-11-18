#!/bin/sh

# Arrêter le script en cas d'erreur
set -e

# Attendre que la base de données soit prête (optionnel mais recommandé)
# Vous pouvez décommenter cette ligne si vous rencontrez des problèmes de connexion au démarrage
# php artisan db:wait --tries=10 --sleep=3

# Lancer les migrations
echo "--- Running database migrations ---"
php artisan migrate --force

# Remplir la base de données avec les données initiales (rôles, etc.)
echo "--- Seeding database ---"
php artisan db:seed --force

# Générer les caches de production avec les bonnes variables d'environnement
echo "--- Caching configuration and routes ---"
php artisan config:cache
php artisan route:cache

# Lancer Supervisor (qui gère Nginx et PHP-FPM)
echo "--- Starting application ---"
exec /usr/bin/supervisord -c /etc/supervisord.conf
