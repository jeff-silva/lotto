<?php

namespace App\Module\Lotto\Services;

use App\Addon\Service\Service;
use App\Module\Lotto\Models\LottoRaffleType;
use App\Module\Lotto\Search\LottoRaffleDrawSearch;
use App\Module\Lotto\Algorithm;
use Illuminate\Support\Str;

class LottoRaffleTypeService extends Service
{
  public function __construct(
    protected LottoRaffleType $model,
  ) {}

  public function analisys($lottoRaffleType, array $numbers)
  {
    $draws = LottoRaffleDrawSearch::make()->get([
      'type_id' => $lottoRaffleType->id,
      'order' => 'id:asc',
    ]);

    $scope = [];

    foreach (Algorithm\Algorithm::all() as $class) {
      $key = Str::snake(preg_replace('/Algorithm$/', '', class_basename($class)));
      $scope[$key] = call_user_func([$class, 'make'], $draws, $numbers);
    }

    return $scope;
  }
}
