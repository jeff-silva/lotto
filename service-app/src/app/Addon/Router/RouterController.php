<?php

namespace App\Addon\Router;

use App\Http\Controllers\Controller;

class RouterController extends Controller
{
  public $route = '';
  public $methods = ['get'];
  public $middlewares = [];
  public $enabled = true;
}
