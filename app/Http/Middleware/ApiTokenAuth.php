<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('X-API-TOKEN');

        if (!$token || $token !== env('API_TOKEN')) {
            return response()->json([
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        return $next($request);
    }
}
