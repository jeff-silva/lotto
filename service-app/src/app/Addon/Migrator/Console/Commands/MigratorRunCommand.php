<?php

namespace App\Addon\Migrator\Console\Commands;

use Illuminate\Console\Command;

class MigratorRunCommand extends Command
{

  protected $signature = 'migrator:run';

  protected $description = 'Migrator Configuration';

  public function handle()
  {
    \App\Addon\Migrator\Migrator::run();
  }
}
