<?php

namespace App\Module\Lotto\Http\Controllers\LottoRaffleType;

use Illuminate\Http\Request;
use App\Addon\Router\RouterController;
use App\Module\Lotto\Search\LottoRaffleTypeSearch;

class LottoRaffleTypeSearchController extends RouterController
{
  public $route = '/api/lotto_raffle_type';
  public $methods = ['get'];
  public $tags = ['lotto_raffle_type'];

  public function __invoke(Request $request)
  {
    return LottoRaffleTypeSearch::make()->paginate($request->query());
  }

  public static function openApiParams()
  {
    return LottoRaffleTypeSearch::openApiParams();
  }
}
