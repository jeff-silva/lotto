<?php

namespace App\Addon\Router\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Addon\Router\RouterController;

class OpenApiController extends RouterController
{
  public $route = '/api/openapi';
  public $methods = ['get'];
  public $tags = ['api'];

  public function __invoke(Request $request)
  {
    $response = (object) [
      'openapi' => '3.0.4',
      'info' => [
        'version' => '1.0.27',
        'title' => config('app.name'),
        'description' => '',
        'termsOfService' => '',
        'contact' => [
          'email' => 'main@grr.la',
        ],
        'license' => [
          'name' => 'Apache 2.0',
          'url' => '',
        ],
      ],
      'externalDocs' => [
        'description' => '',
        'url' => '',
      ],
      'servers' => [
        ['url' => url('/api')],
      ],
      'tags' => [],
      'paths' => [],
    ];

    foreach (Route::getRoutes() as $route) {
      if (!isset($route->defaults['openapi'])) continue;
      $openapi = $route->defaults['openapi'];

      $uri = '/' . ltrim($route->uri, '/api');
      if ($uri == '/') continue;

      if (!isset($response->paths[$uri])) {
        $response->paths[$uri] = [];
      }

      foreach ($route->methods as $method) {
        $method = strtolower($method);
        if (in_array($method, ['head'])) continue;
        $response->paths[$uri][$method] = $openapi;

        foreach ($openapi->tags as $tag) {
          $response->tags[$tag] = $tag;
        }
      }
    }

    $response->tags = array_values($response->tags);
    return $response;
  }
}
