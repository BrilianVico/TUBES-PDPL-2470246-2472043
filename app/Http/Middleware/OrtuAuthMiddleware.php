<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OrtuAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('ortu_logged_in')) {
            return redirect()
                ->route('login.ortu')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
