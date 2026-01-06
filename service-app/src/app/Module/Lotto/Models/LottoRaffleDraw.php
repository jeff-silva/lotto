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

  protected $hidden = [
    'raw',
  ];

  public function type(): HasOne
  {
    return $this->hasOne(LottoRaffleType::class, 'id', 'type_id');
  }

  public function getPrevAttribute()
  {
    return static::query()
      ->where('type_id', $this->type_id)
      ->where('number', $this->number - 1)
      ->first();
  }

  public function getNextAttribute()
  {
    return static::query()
      ->where('type_id', $this->type_id)
      ->where('number', $this->number + 1)
      ->first();
  }
}
