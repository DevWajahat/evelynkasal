<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = auth()->user();

        if ($user && $user->role == 'admin') {
            return $next($request);
        }

        return redirect()->route('admin.login');
    }
}
