<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $role = strtolower(trim(auth()->user()->role));

        if ($role === "admin") {
            return $next($request);
        } else {
            abort(403, "You didn't have permission to access that page");
        }

    }
}
