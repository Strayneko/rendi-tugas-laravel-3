<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NoAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->isStarted()) session()->start();
        if (session()->get('logged', false)) return redirect()->route('home.product');
        return $next($request);
    }
}
