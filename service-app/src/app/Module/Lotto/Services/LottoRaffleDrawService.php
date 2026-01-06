<?php

namespace App\Module\Lotto\Services;

use App\Addon\Service\Service;
use App\Module\Lotto\Models\LottoRaffleDraw;

class LottoRaffleDrawService extends Service
{
  public function __construct(
    protected LottoRaffleDraw $model,
  ) {}
}
