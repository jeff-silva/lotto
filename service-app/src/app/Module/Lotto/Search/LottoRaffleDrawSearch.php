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
}
