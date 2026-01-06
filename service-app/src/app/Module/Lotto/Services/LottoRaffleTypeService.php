<?php

namespace App\Module\Lotto\Services;

use App\Addon\Service\Service;
use App\Module\Lotto\Models\LottoRaffleType;
use App\Module\Lotto\Search\LottoRaffleDrawSearch;

class LottoRaffleTypeService extends Service
{
  public function __construct(
    protected LottoRaffleType $model,
  ) {}

  public function analisys($lottoRaffleType, array $numbers)
  {
    // $draws = LottoRaffleDrawSearch::make()->get([
    //   'type_id' => $lottoRaffleType->id,
    //   'order' => 'id:asc',
    // ]);

    $scope = (object) [];

    return $scope;

    /**
     * Tipos de algoritmo:
     * - Numérico
     */
  }
}
