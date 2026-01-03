<?php

namespace App\Addon\Migrator\Examples;

use App\Addon\Migrator\Migrator;

class TestPlaceCountryStateMigrator extends Migrator
{
  public $table = 'public.test_place_country_state';
  public $depends_on = ['public.test_place_country'];
  public $enabled = false;

  public function fields()
  {
    return [
      'id' => fn($table) => $table->id(),
      'name' => fn($table) => $table->string('name'),
      // 'country_id' => fn($table) => $table->foreign('country_id')
      //   ->references('id')->on('public.test_place_country')
      //   ->onUpdate('cascade')->onDelete('cascade'),
      'country_id' => fn($table) => $table->foreignId('country_id')
        ->constrained('public.test_place_country')
        ->onUpdate('cascade')
        ->onDelete('cascade'),
      'created_at' => fn($table) => $table->dateTime('created_at'),
      'updated_at' => fn($table) => $table->dateTime('updated_at'),
      'deleted_at' => fn($table) => $table->dateTime('deleted_at'),
    ];
  }
}
