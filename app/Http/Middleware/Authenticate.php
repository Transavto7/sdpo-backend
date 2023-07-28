<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->get('password') !== env('APP_PASSWORD', '123456789')) {
            return redirect('login');
        }

        return $next($request);
    }
}
