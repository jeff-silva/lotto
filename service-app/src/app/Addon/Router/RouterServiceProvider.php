<?php

namespace App\Addon\Router;

use Symfony\Component\Finder\Finder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouterServiceProvider extends ServiceProvider
{
  public function register(): void
  {
    // 
  }

  public function boot(): void
  {
    if ($this->app->routesAreCached()) {
      return;
    }

    $files = collect(iterator_to_array(
      (new Finder)->files()
        ->in(app_path())
        ->name('*Controller.php')
    ))
      ->map(function ($file) {
        $file->class = $file->getRealPath();
        $file->class = str_replace(app_path(), 'App', $file->class);
        $file->class = preg_replace('/.php$/', '', $file->class);
        $file->class = str_replace('/', '\\', $file->class);

        return $file;
      })
      ->filter(function ($file) {
        return is_subclass_of($file->class, RouterController::class);
      });

    foreach ($files as $file) {
      $c = (object) (new \ReflectionClass($file->class))->getDefaultProperties();
      if (!$c->enabled) continue;
      $route = Route::match($c->methods, $c->route, $file->class);
      $route->name(preg_replace('/Controller$/', '', class_basename($file->class)));
      $route->middleware($c->middlewares);
      $route->defaults('openapi', call_user_func([$file->class, 'getOpenApi']));
    }

    $this->loadViewsFrom(app_path('Addon/Router/Views'), 'addon.router');
  }
}
