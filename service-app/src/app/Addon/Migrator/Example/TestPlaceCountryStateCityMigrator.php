<?php

namespace App\Addon\Migrator\Example;

use App\Addon\Migrator\Migrator;

class TestPlaceCountryStateCityMigrator extends Migrator
{
  public $table = 'public.test_place_country_state_city';
  public $depends_on = ['public.test_place_country_state'];

  public function fields()
  {
    return [
      'id' => fn($table) => $table->id(),
      'name' => fn($table) => $table->string('name'),
      // 'state_id' => fn($table) => $table->foreign('state_id')
      //   ->references('id')->on('test_place_country_state')
      //   ->onUpdate('cascade')->onDelete('cascade'),
      'state_id' => fn($table) => $table->foreignId('state_id')
        ->constrained('public.test_place_country_state')
        ->onUpdate('cascade')
        ->onDelete('cascade'),
      'created_at' => fn($table) => $table->dateTime('created_at'),
      'updated_at' => fn($table) => $table->dateTime('updated_at'),
      'deleted_at' => fn($table) => $table->dateTime('deleted_at'),
    ];
  }
}
