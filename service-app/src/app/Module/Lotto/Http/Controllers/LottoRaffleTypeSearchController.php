<?php

namespace App\Module\Lotto\Http\Controllers;

use Illuminate\Http\Request;
use App\Addon\Router\RouterController;

class LottoRaffleTypeSearchController extends RouterController
{
  public $route = '/api/lotto_raffle_type';
  public $methods = ['get'];
  public $tags = ['lotto_raffle_type'];

  public function __invoke(Request $request)
  {
    return $request->all();
  }
}
