<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission): Response
    {
        if (!auth()->check()) {
            abort(401);
        }

        if (!auth()->user()->hasPermission($permission)) {
            abort(403);
        }

        return $next($request);
    }
}