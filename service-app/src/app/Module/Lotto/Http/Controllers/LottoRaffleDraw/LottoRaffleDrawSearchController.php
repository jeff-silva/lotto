<?php

namespace App\Module\Lotto\Http\Controllers\LottoRaffleDraw;

use Illuminate\Http\Request;
use App\Addon\Router\RouterController;
use App\Module\Lotto\Search\LottoRaffleDrawSearch;

class LottoRaffleDrawSearchController extends RouterController
{
  public $route = '/api/lotto_raffle_draw';
  public $methods = ['get'];
  public $tags = ['lotto_raffle_draw'];

  public function __invoke(Request $request)
  {
    return $request->all();
  }

  public static function openApiParams()
  {
    return LottoRaffleDrawSearch::openApiParams();
  }
}
