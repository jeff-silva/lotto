<?php

namespace App\Module\Lotto\Http\Controllers;

use Illuminate\Http\Request;
use App\Addon\Router\RouterController;

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
    return [
      [
        'name' => 'page',
        'in' => 'query',
      ],
    ];
  }
}
