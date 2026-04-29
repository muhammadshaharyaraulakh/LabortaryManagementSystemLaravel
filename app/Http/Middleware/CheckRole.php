<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next,...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = strtolower(trim(auth()->user()->role));
        if (in_array($userRole, $roles)) {
            return $next($request);
        } else {
            abort(403, "You didn't have permission to access that page");
        }

    }
}
