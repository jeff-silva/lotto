<?php

namespace App\Module\Lotto\Search;

use App\Addon\Search\Search;
use App\Module\Lotto\Models\LottoRaffleDraw;

class LottoRaffleDrawSearch extends Search
{
  public function __construct(
    public LottoRaffleDraw $model,
  ) {
    return parent::__construct();
  }

  public function params()
  {
    return [
      'type_id' => null,
    ];
  }

  public function query($query, $params)
  {
    if ($value = $params->type_id) {
      $query->where('type_id', $value);
    }
  }
}
