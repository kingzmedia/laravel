<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;


class CheckToken
{

    public function handle($request, Closure $next)
    {


        $user = User::where("api_key", $request->api_key)->first();
        if(!isset($request->api_key) || $request->api_key == "" || !$user) {
            return response([
                'error' => [
                    'code' => 'INSUFFICIENT_ROLE',
                    'description' => 'You are not authorized to access this resource. Missing API_KEY or WRONG API_KEY parametter'
                ]
            ], 401);
        }

        return $next($request);
    }
}
