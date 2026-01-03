<?php

namespace App\Addon\Router;

use App\Http\Controllers\Controller;

class RouterController extends Controller
{
  public $route = '';
  public $methods = ['get'];
  public $middlewares = [];
  public $enabled = true;
  public $tags = [];

  public static function openApi()
  {
    return [];
  }

  public static function getOpenApi()
  {
    $defaults = (object) (new \ReflectionClass(static::class))->getDefaultProperties();
    // dd($defaults);

    $data = (object) array_merge([
      'summary' => '',
      'description' => '',
      'operationId' => '',
      'tags' => $defaults->tags,
    ], static::openApi());

    if (!$data->operationId) {
      $data->operationId = rtrim(class_basename(get_called_class()), 'Controller');
    }

    return $data;
  }
}
