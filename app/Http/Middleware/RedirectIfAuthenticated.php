<?php

namespace App\Http\Middleware;

use App\Models\MsUser;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $ms_user = Auth::user();
            if ($ms_user->is_admin()) {
                return redirect()->route('admin.day');
            }
            return redirect('/');
        }

        return $next($request);
    }
}
