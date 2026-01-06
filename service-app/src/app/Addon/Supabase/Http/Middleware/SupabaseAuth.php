<?php

namespace App\Addon\Supabase\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

// name: auth.supabase
class SupabaseAuth
{
  public function handle(Request $request, Closure $next)
  {
    $token = $request->bearerToken();

    if (!$token) {
      return response()->json(['error' => 'Token não fornecido'], 400);
    }

    try {
      $secret = env('SUPABASE_JWT_SECRET');
      $decoded = JWT::decode($token, new Key($secret, 'HS256'));

      $user = null;
      if ($decoded and $decoded->email) {
        $user = \App\Models\AppUser::where('email', $decoded->email)->first();
      }

      $request->merge(['user' => $user]);
      return $next($request);
    } catch (Exception $e) {
      return response()->json(['error' => 'Token inválido: ' . $e->getMessage()], 400);
    }
  }
}
