<?php

namespace App\Http\Controllers;

use App\Sandwich;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;


class OrderController extends Controller
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
        $orders = [];
        foreach (User::all() as $user) {
            foreach (User::findOrFail($user->id)->sandwiches()->get() as $sandwich) {
                array_push($orders, $sandwich);
            }
        }
        return view('/orders/index')->with(compact('orders'));
    }

    public function index_customers()
    {
        $dup_flag = false;
        $customers = [];
        // Cicla tutti i panini nel DB
        foreach (Sandwich::all() as $sandwich) {
            // Cicla gli utenti associati ad ogni panino (cioè cicla tutte
            // le associazioni tra utente e panino, ovvero gli ordini)
            foreach (Sandwich::findOrFail($sandwich->id)->users()
                // Almeno un record nella tabella pivot deve essere stato creato oggi
                // (per mostrare solo gli utenti che hanno fatto ordinazioni oggi)
                ->wherePivot('created_at', today())->get() as $user) {
                    // Cicla gli utenti
                    foreach ($customers as $element) {
                        // Controlla i duplicati
                        if ($element['id'] == $user['id']) {
                            // Flag per i duplicati
                            $dup_flag = true;   //Flag for duplicates
                        }
                    }
                    if (!$dup_flag) {
                        // Aggiungi l'utente all'array se non è già presente
                        array_push($customers, $user);
                    }
                    // Resetta il flag dopo ogni ordine
                    $dup_flag = false;
            }
        }
        return view('/orders/index')->with(compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\OrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store_api(OrderRequest $request)
    {

        //Carbon::setTestNow(Carbon::create(2001, 5, 21, 12));
        
        // Controllo del blocco temporale (solo per le classi scolastiche)
        // oppure controllo se l'utente loggato ha i permessi per bypassarlo 
        if ($this->checkOrderTime() || in_array($this->logged_user->role, array('bar'))) {
            // Controllo che il panino esista
            if ($sandwich_obj = Sandwich::findOrFail($request->sandwich_id)) {
                $price = $sandwich_obj->price;
            } else {
                return response()->json(['message' => "Errore nell'ordinazione."], 404);
            }
    
            $order = DB::table('orders')->where('user_id', '=', $this->logged_user->id)
                ->where('sandwich_id', '=', $request->get('sandwich_id'))
                ->whereDate('created_at', '=', Carbon::today()->toDateString())
                ->whereNull('deleted_at');
            // Se il panino è stato già ordinato dalla classe nello stesso giorno:
            if ($order->exists()) {
                // Aumento il contatore di 1:
                $times = ($order->select('times')->pluck('times')[0] + 1);
                $order->updated_at = Carbon::now();
                $order->update(['times' => $times]);
                return response()->json(['message' => "Aggiunta effettuata."], 200);

            // Se non è stato ordinato lo inserisco:
            } else {
                try {
                    DB::table('orders')->insert([
                        'user_id' => $this->user_id,
                        'sandwich_id' => $request->get('sandwich_id'),
                        'price' => $price,
                        'times' => '1',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                    return response()->json(['message' => "Nuovo ordine creato."], 201);
                } catch (\Throwable $th) {
                    return response()->json(['message' => $th->getMessage()], 400);
                }
            }
        } else {
            return response()->json(['message' => 'Il tempo limite per le ordinazioni è stato superato.'], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show_list_api($id)
    {
        if ((in_array($this->logged_user->role, array('admin', 'bar')) || $this->logged_user->id == $id)) {
            $list = [];
            $user = User::findOrfail($id);
            foreach ($user->sandwiches()->wherePivot('created_at', today())->get() as $sandwich) {
                array_push($list, $sandwich);
            }
            return response()->json($list);
        }else{
            return response()->json(['message' => "Utente non autorizzato."], 403);
        }
        
    }

    /**
     * Remove the specified resource from storage (recoverable).
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function soft_destroy_api(OrderRequest $request)
    {
        // Controllo del blocco temporale (solo per le classi scolastiche)
        // oppure controllo se l'utente loggato ha i permessi per bypassarlo 
        if ($this->checkOrderTime() || in_array($this->logged_user->role, array('bar'))) {
            // Controllo che il panino esista
            if ($sandwich_obj = Sandwich::findOrFail($request->sandwich_id)) {
                $price = $sandwich_obj->price;
            } else {
                return response()->json(['message' => "Errore nell'ordinazione."], 404);
            }

            $order = DB::table('orders')->where('user_id', '=', $this->user_id)
                ->where('sandwich_id', '=', $request->sandwich_id)
                ->whereDate('created_at', '=', Carbon::today()->toDateString())
                ->whereNull('deleted_at');

            // Se il panino è stato già ordinato dalla classe nello stesso giorno:
            if ($order->exists()) {
                $times = ($order->select('times')->pluck('times')[0]);
                // Se il contatore è maggiore di 1 lo diminuisco di 1:
                if ($times > 1) {
                    $order->update(['updated_at' => Carbon::now()]);
                    $order->update(['times' => $times - 1]);
                    return response()->json(['message' => "Diminuzione effettuata."], 200);
                // Altrimenti elimino il panino
                } else if ($times = 1){
                    try {
                        $order->update(['deleted_at' => Carbon::now()]);
                        return response()->json(['message' => "Rimozione effettuata."], 200);
                    } catch (\Throwable $th) {
                        return response()->json(['message' => $th->getMessage()], 400);
                    }
                }
            // Se non è stato ordinato:
            } else {
                return response()->json(['message' => 'Ordinazione non trovata.'], 404);
            }
        } else {
            return response()->json(['message' => 'Il tempo limite per le ordinazioni è stato superato.'], 403);
        }
    }

    /**
     * Remove the specified resource from storage (not recoverable).
     *
     * @param  \Illuminate\Http\OrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy_api(OrderRequest $request)
    {
        // Attenzione: cancellazione permanente!

        $this->logged_user = $request->user('api');

        // Controllo del blocco temporale (solo per le classi scolastiche)
        // oppure controllo se l'utente loggato ha i permessi per bypassarlo 
        if ($this->checkOrderTime() || in_array($this->logged_user->role, array('bar'))) {
            if ($sandwich_obj = \App\Sandwich::findOrFail($request->get('sandwich_id'))) {
                $price = $sandwich_obj->price;
            } else {
                return response()->json(['message' => "Errore nell'ordinazione."], 404);
            }
       
            $order = DB::table('orders')->where('user_id', '=', $this->user_id)
                ->where('sandwich_id', '=', $request->get('sandwich_id'))
                ->whereDate('created_at', '=', Carbon::today()->toDateString())
                ->whereNull('deleted_at');
            // Se il panino è stato già ordinato dalla classe nello stesso giorno:
            if ($order->exists()) {
                $times = ($order->select('times')->pluck('times')[0]);
                // Se il contatore è maggiore di 1 lo diminuisco di 1:
                if ($times > 1) {
                    $order->update(['updated_at' => Carbon::now()]);
                    $order->update(['times' => $times - 1]);
                    return response()->json(['message' => "Diminuzione effettuata."], 200);
                // Altrimenti elimino il panino
                } else if ($times = 1){
                    try {
                        $order->delete();
                        return response()->json(['message' => "Rimozione effettuata."], 200);
                    } catch (\Throwable $th) {
                        return response()->json(['message' => $th->getMessage()], 400);
                    }
                }
            // Se non è stato ordinato:
            } else {
                return response()->json(['message' => 'Ordinazione non trovata.'], 404);
            }
        } else {
            return response()->json(['message' => 'Il tempo limite per le ordinazioni è stato superato.'], 403);
        }
    }

    /**
     * Ritorna true se si può ancora ordinare, false se non si può (il tempo è scaduto)
     */
    public function checkOrderTime()
    {
        $order_time_limit = DB::table('system_settings')->first()->order_time_limit;
        return Carbon::now()->toTimeString() < $order_time_limit;
    }
    
    /**
     * Ritorna true se l'orario di ordinazione non è passato, false se è passato
     */
    public function checkRetireTime()
    {
        $retire_time = DB::table('system_settings')->first()->retire_time;
        return Carbon::now()->toTimeString() < $retire_time;
    }

    public function print_orders(){
          $orders = DB::table('orders')
           ->whereDate('created_at', '=', Carbon::today()->toDateString())
           ->whereNull('deleted_at')
           ->get();
          $users = User::all();
          $sandwiches = Sandwich::all();
          // Invia i dati alla view usando la funzione loadView della facade PDF
          $pdf = \PDF::loadView('printableList', array('orders' => $orders, 'users' => $users, 'sandwiches' => $sandwiches));
          return $pdf->download('liste.pdf');
    }
}
