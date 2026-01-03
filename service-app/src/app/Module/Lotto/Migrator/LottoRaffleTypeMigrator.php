<?php

namespace App\Module\Lotto\Migrator;

use App\Addon\Migrator\Migrator;

class LottoRaffleTypeMigrator extends Migrator
{
  public $table = 'public.lotto_raffle_type';

  public function fields()
  {
    return [
      'id' => fn($table) => $table->id(),
      'slug' => fn($table) => $table->string('slug')->nullable(),
      'name' => fn($table) => $table->string('name')->nullable(),
      'pool_min' => fn($table) => $table->integer('pool_min')->nullable(),
      'pool_max' => fn($table) => $table->integer('pool_max')->nullable(),
      'pool_cols' => fn($table) => $table->integer('pool_cols')->nullable(),
      'created_at' => fn($table) => $table->dateTime('created_at'),
      'updated_at' => fn($table) => $table->dateTime('updated_at'),
      'deleted_at' => fn($table) => $table->dateTime('deleted_at')->nullable(),
    ];
  }
}
