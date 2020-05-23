<?php

namespace App\Http\Controllers;

use App\Http\Requests\SandwichRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sandwich;

class SandwichController extends Controller
{
    private $logged_user;
    private $user_id;

    public function __construct(Request $request){
        // Utente che fa la chiamata api
        $this->logged_user = $request->user('api');
        // Id dell'utente associato all'ordine
        if ($request->has('api_token')) {
            $this->user_id = in_array($request->user('api')->role, array('bar')) ? $request->user_id : $request->user('api')->id;             
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view-any', Sandwich::class);
        $sandwiches = Sandwich::all();
        return view('/sandwiches/index')->with(compact('sandwiches'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_api()
    {
        $sandwiches = Sandwich::all();
        return $sandwiches;
    }

    public function store_api(SandwichRequest $request)
    {
        if ($this->logged_user->can('create', Sandwich::class)) {
            if(!app(\App\Http\Controllers\OrderController::class)->checkRetireTime()){
                try {
                    $sandwich = new Sandwich;
                    $sandwich->name = $request->name;
                    $sandwich->price = $request->price;
                    $sandwich->description = $request->description;
                    $sandwich->save();
                    return response()->json(['message' => 'Panino creato.'], 200);
                } catch (\Throwable $th) {
                    return response()->json(['message' => "Errore nell'operazione. Ricontrollare i dati inseriti (il panino potrebbe essere già presente)."], 400);
                }
            }else{
                return response()->json(['message' => "Errore nell'operazione. Attendere l'orario di ritiro per effettuare cambiamenti nel listino."], 403);
            }
        }else{
            return response()->json(['message' => "Errore nell'operazione. Utente non autorizzato."], 401);
        }
    }

    /** 
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // I panini non posso essere cancellati (bisogna effettuare un wipe del sistema).
        return false;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function soft_destroy_api($id)
    {
        if ($this->logged_user->can('delete', Sandwich::class)) {
            if(!app(\App\Http\Controllers\OrderController::class)->checkRetireTime()){   // Se l'orario di ritiro è passato si possono eliminare i panini
                $sandwich = Sandwich::findOrFail($id);
                $sandwich->delete();
                return response()->json(['message' => 'Panino eliminato.'], 200);
            }else{
                return response()->json(['message' => "Errore nell'operazione. Attendere l'orario di ritiro per effettuare cambiamenti nel listino."], 403);
            }
        }else{
            return response()->json(['message' => "Errore nell'operazione. Utente non autorizzato."], 401);
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore_api($id)
    {    
        /*    
        $sandwich = Sandwich::withTrashed()->findOrFail($id);
        if($this->logged_user->can('restore', $sandwich)){
            $sandwich->restore();
            return response()->json(['message' => 'Panino abilitato.'], 200);
        }else{
            return response()->json(['message' => "Errore nell'operazione. Utente non autorizzato."], 401);
        }
        */
        
        // I panini non dovrebbero essere ripristinati, ma ricreati  per un motivo
        // di storico delle vendite.
        return response()->json(['message' => "Operazione non consentita."], 401);
        
    }
}
