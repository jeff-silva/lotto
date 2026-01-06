<?php

namespace App\Module\Lotto\Search;

use App\Addon\Search\Search;
use App\Module\Lotto\Models\LottoRaffleType;

class LottoRaffleTypeSearch extends Search
{
  public function __construct(
    public LottoRaffleType $model,
  ) {
    return parent::__construct();
  }

  public function find($query, $params)
  {
    if (is_numeric($params->find)) {
      $query->where('id', $params->find);
    } else {
      $query->where('slug', $params->find);
    }
  }
}
