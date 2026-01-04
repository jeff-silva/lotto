<?php

namespace App\Module\Lotto\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LottoRaffleType extends Model
{
  protected $table = 'public.lotto_raffle_type';

  protected $fillable = [
    'slug',
    'name',
    'color',
    'order',
    'pool_min',
    'pool_max',
    'pool_cols',
  ];

  public function lastDraw(): HasOne
  {
    return $this->hasOne(LottoRaffleDraw::class, 'type_id', 'id')->latestOfMany();
  }
}
