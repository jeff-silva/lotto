<?php

namespace App\Module\Lotto\Http\Controllers\LottoRaffleType;

use Illuminate\Http\Request;
use App\Addon\Router\RouterController;
use App\Module\Lotto\Search\LottoRaffleTypeSearch;

class LottoRaffleTypeSelectController extends RouterController
{
  public $route = '/api/lotto_raffle_type/{id}';
  public $methods = ['get'];
  public $tags = ['lotto_raffle_type'];

  public function __invoke($id, Request $request)
  {
    $request->query->add(['find' => $id]);
    $scope = (object) [];
    $scope->entity = LottoRaffleTypeSearch::make()->first($request->query());
    return $scope;
  }
}
