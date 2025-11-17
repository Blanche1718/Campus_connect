#!/usr/bin/env bash
# exit on error
set -o errexit

echo "Build script started..."

# Exécuter les migrations de la base de données
echo "Running database migrations..."
php artisan migrate --force

echo "Build script finished successfully!"