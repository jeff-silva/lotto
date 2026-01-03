<?php

namespace App\Addon\Migrator\Example;

use App\Addon\Migrator\Migrator;

class TestPlaceCountryMigrator extends Migrator
{
  public $table = 'public.test_place_country';
  public $enabled = false;

  public function fields()
  {
    return [
      'id' => fn($table) => $table->id(),
      'name' => fn($table) => $table->string('name'),
      'created_at' => fn($table) => $table->dateTime('created_at'),
      'updated_at' => fn($table) => $table->dateTime('updated_at'),
      'deleted_at' => fn($table) => $table->dateTime('deleted_at'),
    ];
  }
}
