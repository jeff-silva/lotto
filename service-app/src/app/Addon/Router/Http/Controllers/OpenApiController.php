<?php

namespace App\Addon\Router\Http\Controllers;

use Illuminate\Http\Request;
use App\Addon\Router\RouterController;

class OpenApiController extends RouterController
{
  public $route = '/api/openapi';
  public $methods = ['get'];

  public function __invoke(Request $request)
  {
    return $request->all();
  }
}
