<?php

namespace App\Model\Lotto\Search;

use App\Addon\Search\Search;
use App\Module\Lotto\Models\LottoRaffleType;

class LottoRaffleTypeSearch extends Search
{
  public function __construct(
    public LottoRaffleType $model,
  ) {
    return parent::__construct();
  }
}
