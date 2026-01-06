<?php

namespace App\Module\Lotto\Services;

use App\Addon\Service\Service;
use App\Module\Lotto\Models\LottoRaffleType;

class LottoRaffleTypeService extends Service
{
  public function __construct(
    protected LottoRaffleType $model,
  ) {}
}
