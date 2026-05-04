<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfApiAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('api_token')) {
            return redirect()->route('products.index');
        }

        return $next($request);
    }
}
