<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\DB;

class SessionTimeout {

    protected $session;
    protected $timeout;

    public function __construct(Store $session){
        $this->session = $session;
        $this->timeout = DB::table('system_settings')->first()->session_timeout;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ((Session::has('lastActivityTime')) && time() - Session::get('lastActivityTime') > $this->timeout) {
            Session::flush();
            return redirect('/');
        }

        Session::put('lastActivityTime', time());

        return $next($request);
    }

}