<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{   
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param string $role
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();
        if (!$user) {
            session(['url.intended' => $request->fullUrl()]);
            Log::info('User not authenticated');
            return redirect()->route('auth.login');
        }

        if (!$user->hasRole($role)) {
            Log::info('User does not have the correct role');
            return response()->view('error.404');
        }
        Log::info('User passed role check');
        return $next($request);
    }
}
