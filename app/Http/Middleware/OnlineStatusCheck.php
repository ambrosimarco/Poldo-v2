<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class OnlineStatusCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\DB::table('system_settings')->first()->online) {
            return $next($request);
        } else {
            if (Auth::user()->role == 'admin') {
                return $next($request);
            } else {
                $message = \DB::table('system_settings')->first()->offline_message;
                return abort(503, $message);   // Codice 503 (manutenzione)
            }
        }
        
    }
}
