<?php

namespace App\Addon\Router\Http\Controllers;

use Illuminate\Http\Request;
use App\Addon\Router\RouterController;

class ApiController extends RouterController
{
  public $route = '/api';
  public $methods = ['get'];

  public function __invoke(Request $request)
  {
    return view('addon.router::index');
  }
}
