<?php

namespace App\Module\Lotto\Http\Controllers\LottoRaffleType;

use Illuminate\Http\Request;
use App\Addon\Router\RouterController;

class LottoRaffleTypeUpsertController extends RouterController
{
  public $route = '/api/lotto_raffle_type';
  public $methods = ['post'];
  public $tags = ['lotto_raffle_type'];
  public $middlewares = ['auth.supabase'];

  public function __invoke(Request $request)
  {
    return $request->all();
  }

  public static function openApiParams()
  {
    return [
      [
        'in' => 'body',
        'name' => 'name',
        'example' => 'Mega Sena',
      ],
    ];
  }
}
