<?php

namespace App\Module\Lotto\Http\Controllers\LottoRaffleDraw;

use Illuminate\Http\Request;
use App\Addon\Router\RouterController;
use App\Module\Lotto\Search\LottoRaffleDrawSearch;

class LottoRaffleDrawSelectController extends RouterController
{
  public $route = '/api/lotto_raffle_draw/{id}';
  public $methods = ['get'];
  public $tags = ['lotto_raffle_draw'];
  public $middlewares = ['auth.supabase'];

  public function __invoke($id, Request $request)
  {
    $request->query->add(['find' => $id]);
    $scope = (object) [];
    $scope->entity = LottoRaffleDrawSearch::make()->first($request->query());
    $scope->entity->append('prev');
    $scope->entity->append('next');
    return $scope;
  }
}
