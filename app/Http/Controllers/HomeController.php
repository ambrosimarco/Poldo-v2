<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function order(){
        $sandwiches = app()->call('App\Http\Controllers\SandwichController@index_api');
        return view('order')->with(compact('sandwiches'));
    }

    public function contacts(){
        return view('contacts');
    }

    public function settings(){  
        return view('settings/index');        
    }
}
