<?php

namespace App\Module\Lotto\Migrator;

use App\Addon\Migrator\Migrator;

class LottoRaffleDrawMigrator extends Migrator
{
  public $table = 'public.lotto_raffle_draw';
  public $depends_on = ['public.lotto_raffle_type'];

  public function fields()
  {
    return [
      'id' => fn($table) => $table->id(),
      'type_id' => fn($table) => $table->foreignId('type_id')
        ->constrained('public.lotto_raffle_type')
        ->onUpdate('cascade')
        ->onDelete('cascade'),
      'number' => fn($table) => $table->integer('number')->nullable(),
      'result' => fn($table) => $table->jsonb('result')->nullable(),
      'date' => fn($table) => $table->dateTime('date')->nullable(),
      'created_at' => fn($table) => $table->dateTime('created_at'),
      'updated_at' => fn($table) => $table->dateTime('updated_at'),
    ];
  }
}
