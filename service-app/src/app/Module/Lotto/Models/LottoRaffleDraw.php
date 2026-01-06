<?php

namespace App\Module\Lotto\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LottoRaffleDraw extends Model
{
  protected $table = 'public.lotto_raffle_draw';

  protected $fillable = [
    'type_id',
    'type',
    'number',
    'result',
    'raw',
    'drawn_at',
  ];

  protected $casts = [
    'result' => 'json',
    'raw' => 'json',
  ];

  public function type(): HasOne
  {
    return $this->hasOne(LottoRaffleType::class, 'id', 'type_id');
  }
}
