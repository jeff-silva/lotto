<?php

return [
    App\Providers\AppServiceProvider::class,

    // Addons
    App\Addon\Migrator\MigratorServiceProvider::class,
    App\Addon\Router\RouterServiceProvider::class,

    // Modules
    App\Module\Lotto\LottoServiceProvider::class,
];
