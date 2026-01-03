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

    $params = static::getOpenApiParams();
    $data->parameters = $params->filter(fn($param) => $param->in != 'body');
    $requestBody = $params->filter(fn($param) => $param->in == 'body');

    if (!$requestBody->isEmpty()) {
      $properties = [];

      foreach ($requestBody as $param) {
        $properties[$param->name] = [
          'type' => $param->type,
          'example' => $param->example,
        ];
      }

      $data->requestBody = [
        'description' => '',
        'content' => [
          'application/json' => [
            'schema' => [
              'type' => 'object',
              'required' => [],
              'properties' => $properties,
            ],
          ],
        ],
      ];
    }

    // dump($requestBody->toArray());

    return $data;
  }

  public static function openApiParams()
  {
    return [];
  }

  public static function getOpenApiParams()
  {
    return collect(static::openApiParams())
      ->map(function ($param) {
        return (object) array_merge([
          'name' => '',
          'in' => 'query',
          'description' => '',
          'required' => false,
          'type' => 'string',
          'example' => '',
        ], $param);
      });
  }
}
