#!/bin/bash

# Créer le .env si absent
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Injecter les variables d'environnement Railway dans le .env
printenv | grep -E "^(APP_|DB_|CACHE_|SESSION_|QUEUE_|MAIL_|AWS_)" | while IFS='=' read -r key value; do
    sed -i "s|^${key}=.*|${key}=${value}|" /var/www/html/.env
    grep -q "^${key}=" /var/www/html/.env || echo "${key}=${value}" >> /var/www/html/.env
done

# Générer la clé app
php artisan key:generate --force

# Lancer les migrations seulement si DB est disponible
php artisan migrate --force 2>/dev/null || echo "Migration skipped - DB not ready"

# Lier le storage
php artisan storage:link --force 2>/dev/null

# Optimiser
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Démarrer PHP-FPM en arrière-plan
php-fpm -D

# Démarrer Nginx au premier plan
nginx -g "daemon off;"
