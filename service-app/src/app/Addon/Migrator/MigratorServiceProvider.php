<?php

namespace App\Addon\Migrator;

use Illuminate\Support\ServiceProvider;

class MigratorServiceProvider extends ServiceProvider
{
  public function register(): void
  {
    //
  }

  public function boot(): void
  {
    $this->commands([
      \App\Addon\Migrator\Console\Commands\MigratorRunCommand::class,
    ]);
  }
}
