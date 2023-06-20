<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use PHPUnit\Util\Json;

class AuthenticateAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $allowedSecrets = explode(',', env('ALLOWED_SECRETS'));
        
        if (in_array($request->header('Authorization'), $allowedSecrets)) {
            return $next($request);
        }
        return  response()->json(['error'=>'Unauthorized'],Response::HTTP_UNAUTHORIZED);
        // abort(Response::HTTP_UNAUTHORIZED);
    }
}

