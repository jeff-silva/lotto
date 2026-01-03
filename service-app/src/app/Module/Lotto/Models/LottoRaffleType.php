<?php

namespace App\Module\Lotto\Models;

use Illuminate\Database\Eloquent\Model;

class LottoRaffleType extends Model
{
  protected $table = 'public.lotto_raffle_type';

  protected $fillable = [
    'slug',
    'name',
    'pool_min',
    'pool_max',
    'pool_cols',
  ];
}
