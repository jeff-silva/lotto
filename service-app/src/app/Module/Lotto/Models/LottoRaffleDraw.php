<?php

namespace App\Module\Lotto\Models;

use Illuminate\Database\Eloquent\Model;

class LottoRaffleDraw extends Model
{
  protected $table = 'public.lotto_raffle_draw';

  protected $fillable = [
    'type_id',
    'number',
    'result',
    'raw',
    'drawn_at',
  ];

  protected $casts = [
    'result' => 'json',
    'raw' => 'json',
  ];
}
