<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Hash;
use App\User;

class SettingsController extends Controller
{

    public function index(){
        try {
            if(Auth::user()->canAdminEdit()){
                $settings = \DB::table('system_settings')->first();        
                return view('settings/index')->with(compact('settings'));        
            }else{
                return view('users/changePassword');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }
    
    public function update(Request $request){
        if(Auth::user()->canAdminEdit()){
            dd('admin');
            $validatedData = $request->validate([
                'online' => 'boolean',
                'debug_mode' => 'boolean',
                'offline_message' => 'string|max:250',
                'order_time_limit' => 'regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$',
                'retire_time' => 'regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$',
            ]);
            $settings = \DB::table('system_settings')->first();        
            foreach ($changes as $validatedData => $value) {
                $settings->update([$value => $value]);
            }
            $settings->save();
        }else{
            if(SettingsController::changePassword($request)){
                return redirect('/')->withSuccess('Password cambiata con successo.');
            }else{
                return redirect()->back()->withErrors(['msg', "Errore nell'operazione."]);
            }
        } 
    }

    public function changePassword(Request $request){

        $validatedData = $request->validate([
            'id' => 'required',
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:3|different:old_password|confirmed',  
        ]);
        if(Hash::check($validatedData["old_password"], Auth::user()->password )){
            $user = User::findOrFail($validatedData["id"]);
            $user->password = Hash::make($validatedData["new_password"]);
            $user->save();
            return true;
        }else{
            return false;
        }
    }

}
