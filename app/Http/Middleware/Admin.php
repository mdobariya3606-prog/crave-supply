<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    // 1 hour limit
    private const SESSION_TIMEOUT = 1 * 60 * 60;

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless($request->user()?->role === 'admin', 403);

        $lastActivity = $request->session()->get('admin_last_activity');
        if ($lastActivity !== null && now()->timestamp - $lastActivity >= self::SESSION_TIMEOUT) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('status', 'Your admin session expired after 1 hour of inactivity. Please log in again.');
        }

        $request->session()->put('admin_last_activity', now()->timestamp);

        return $next($request);
    }
}
