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
      'name' => fn($table) => $table->string('name'),
      'created_at' => fn($table) => $table->dateTime('created_at'),
      'updated_at' => fn($table) => $table->dateTime('updated_at'),
      'deleted_at' => fn($table) => $table->dateTime('deleted_at'),
    ];
  }
}
