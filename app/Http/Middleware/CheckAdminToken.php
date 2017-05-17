<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!isset($request->api_key) || $request->api_key == "" || $request->api_key != env("API_ADMIN_TOKEN")) {
            return response([
                'error' => [
                    'code' => 'INSUFFICIENT_ROLE',
                    'description' => 'You are not authorized to access this resource.'
                ]
            ], 401);
        }

        return $next($request);
    }
}
