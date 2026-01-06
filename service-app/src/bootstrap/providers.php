<?php

return [
    App\Providers\AppServiceProvider::class,

    // Addons
    App\Addon\Migrator\MigratorServiceProvider::class,
    App\Addon\Router\RouterServiceProvider::class,
    App\Addon\Supabase\SupabaseServiceProvider::class,

    // Modules
    App\Module\Lotto\LottoServiceProvider::class,
];
