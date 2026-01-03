<?php

namespace App\Addon\Router\Examples;

use Illuminate\Http\Request;
use App\Addon\Router\RouterController;

class TestController extends RouterController
{
  public $route = '/api/test';
  public $methods = ['get'];
  public $middlewares = [];
  public $enabled = false;

  public function __invoke(Request $request)
  {
    return $request->all();
  }
}
