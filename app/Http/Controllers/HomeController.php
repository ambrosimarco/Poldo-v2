<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

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

    public function order(){
        $sandwiches = app()->call('App\Http\Controllers\SandwichController@index_api');
        return view('order')->with(compact('sandwiches'));
    }

    public function contacts(){
        return view('contacts');
    }

    public function print_index(){  
        return view('print');        
    }
}
