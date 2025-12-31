#!/bin/sh

export SERVICE_APP_INIT="php artisan serve --host=0.0.0.0 --port=80"
# export SERVICE_APP_INIT="php artisan octane:start --server=frankenphp --host=0.0.0.0 --port=80 --admin-port=2019 --caddyfile=/app/Caddyfile --watch"
docker compose up --build --force-recreate --remove-orphans

# docker compose up -d
# (cd service-supabase/src && docker compose up)