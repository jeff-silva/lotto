<?php

namespace App\Addon\Supabase;

use App\Addon\Supabase\Http\Middleware\SupabaseAuth;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class SupabaseServiceProvider extends ServiceProvider
{
  public function register(): void
  {
    // 
  }

  public function boot(Router $router): void
  {
    $router->aliasMiddleware('auth.supabase', SupabaseAuth::class);
  }
}
