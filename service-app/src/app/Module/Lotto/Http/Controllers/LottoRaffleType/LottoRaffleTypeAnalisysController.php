<?php

namespace App\Module\Lotto\Http\Controllers\LottoRaffleType;

use Illuminate\Http\Request;
use App\Addon\Router\RouterController;
use App\Module\Lotto\Search\LottoRaffleTypeSearch;
use App\Module\Lotto\Services\LottoRaffleTypeService;

class LottoRaffleTypeAnalisysController extends RouterController
{
  public $route = '/api/lotto_raffle_type/{id}/analisys';
  public $methods = ['post'];
  public $tags = ['lotto_raffle_type'];
  public $middlewares = ['auth.supabase'];

  public function __invoke($id, Request $request)
  {
    $scope = (object) [];

    $request->query->add(['find' => $id]);

    $lottoRaffleType = LottoRaffleTypeSearch::make()->first($request->query());
    $scope->entity = $lottoRaffleType;

    $lottoRaffleTypeService = LottoRaffleTypeService::make();
    $scope->analisys = $lottoRaffleTypeService->analisys($lottoRaffleType, $request->post('numbers', []));

    return $scope;
  }

  public static function openApiParams()
  {
    return [
      [
        'in' => 'body',
        'name' => 'numbers',
        'example' => '[1,2,3]',
      ],
    ];
  }
}
