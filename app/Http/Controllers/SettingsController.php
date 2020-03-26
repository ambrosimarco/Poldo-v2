<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\SettingsRequest;

class SettingsController extends Controller
{

    public function index(){
        if(Auth::user()->canAdminEdit()){
            $settings = \DB::table('system_settings')->first();        
            return view('settings/index')->with(compact('settings'));        
        }else{
            return view('users/changePassword');
        }
    }
    
    public function update(SettingsRequest $request){
        if(Auth::user()->canAdminEdit()){
            $settings = \DB::table('system_settings')->first();        
            foreach ($changes as $request => $value) {
                $settings->update([$value => $value]);
            }
            $settings->save();
        }else{
            return redirect()->back()->withErrors(['msg', 'Operazione non autorizzata.']);
        } 
    }

}
