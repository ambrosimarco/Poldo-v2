<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Hash;
use App\User;

class SettingsController extends Controller
{

    public function index(){
        try {
            if(Auth::user()->canAdminEdit()){
                $settings = DB::table('system_settings')->first();        
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
            $validatedData = $request->validate([
                'online' => 'in:on',
                'debug_mode' => 'in:on',
                'no_wipe' => 'in:on',
                'offline_message' => 'string|max:250',
                'order_time_limit' => ['regex:/^((([01]?[0-9]|2[0-3])[:][0-5][0-9])?)$/'],
                'retire_time' => ['regex:/^((([01]?[0-9]|2[0-3])[:][0-5][0-9])?)$/'],
                'session_timeout' => 'integer',
                'password' => ''
            ]);

            // Imposta il valore del flag online
            if (array_key_exists('online', $validatedData)) {
                $validatedData['online'] = '1';
            } else {
                $validatedData['online'] = '0';
            }

            // Imposta il valore del flag debug_mode
            if (array_key_exists('debug_mode', $validatedData)) {
                $validatedData['debug_mode'] = '1';
            } else {
                $validatedData['debug_mode'] = '0';
            }

            // Imposta il valore del flag no_wipe
            if (array_key_exists('no_wipe', $validatedData)) {
                $validatedData['no_wipe'] = '1';
            } else {
                $validatedData['no_wipe'] = '0';
            }

            // Controllo password
            if (!(\Hash::check($request->password, Auth::user()->password))) {
                return redirect()->back()->withErrors(['msg', "Password errata."]);
            }
            
            // Update delle impostazioni nel DB
            unset($validatedData['password']);  // Rimuovi il campo password
            $settings = DB::table('system_settings')->limit(1);        
            foreach ($validatedData as $key => $value) {
                $settings->update([$key => $value]);
            }
            return redirect('/')->withSuccess('Modifiche effettuate con successo.');

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

    public function wipe_system_api(){
        $no_wipe = DB::table('system_settings')->first()->no_wipe;
        if($no_wipe){
            return response()->json(['message' => "Impossibile effettuare il wipe del sistema. Il vincolo no-wipe è abilitato."], 403); 
        }
        $this->authorize('wipe', User::class);
        DB::table('orders')->truncate();
        DB::table('pairings')->truncate();
        DB::table('ingredients')->where('id', '>', '0')->delete();
        DB::table('sandwiches')->where('id', '>', '0')->delete();
        DB::table('users')->where('role', 'not like', 'admin')->delete();

        //Ripristino impostazioni di default del sistema
        DB::table('system_settings')->truncate();
        DB::table('system_settings')->insert(['id' => '1']);

        return response()->json(['message' => 'System wipe completato.'], 200);
    }
}