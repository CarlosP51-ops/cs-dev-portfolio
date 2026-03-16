#!/bin/bash

# Générer la clé app si elle n'existe pas
php artisan key:generate --force

# Lancer les migrations
php artisan migrate --force

# Lier le storage
php artisan storage:link --force

# Optimiser
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Démarrer PHP-FPM en arrière-plan
php-fpm -D

# Démarrer Nginx au premier plan
nginx -g "daemon off;"
