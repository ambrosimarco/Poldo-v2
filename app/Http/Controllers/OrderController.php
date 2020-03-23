<?php

namespace App\Http\Controllers;

use App\Sandwich;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\OrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store_api(OrderRequest $request)
    {
        if($sandwich_obj = Sandwich::findOrFail($request->get('sandwich_id'))){
            $price = $sandwich_obj->price;
        }else{
            return ['success' => false, 'message' => "Errore nell'ordinazione"];
        }

        // Check if the sandwich was already ordered by the school class
        // in the same day.            
        $order = \DB::table('orders')->where('user_id', '=', $request->get('user_id'))
                                    ->where('sandwich_id', '=', $request->get('sandwich_id'))
                                    ->whereDate('created_at', '=', Carbon::today()->toDateString())
                                    ->whereNull('deleted_at');
        if($order->exists()){
            $times = ($order->select('times')->pluck('times')[0] + 1);
            $order->updated_at = Carbon::now(); 
            $order->update(['times' => $times]);
            return ['success' => true, 'message' => 'Aggiunta effettuata.'];   
        
        // Otherwise
        }else{
            try {
                $price = Sandwich::findOrFail($request->get('sandwich_id'))->price;
                \DB::table('orders')->insert([
                    'user_id' => $request->get('user_id'),
                    'sandwich_id' => $request->get('sandwich_id'),
                    'price' => $price,
                    'times' => '1',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                return ['success' => true, 'message' => 'Nuovo ordine creato'];

            } catch (\Throwable $th) {
                return ['success' => false, 'message' => $th->getMessage()];
            }
        }      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        // Attenzione: cancellazione permanente!
        
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \Illuminate\Http\OrderRequest  $request
    * @return \Illuminate\Http\Response
    */
    public function destroy_api(OrderRequest $request)
    {
        // Attenzione: cancellazione permanente!

        if($sandwich_obj = \App\Sandwich::findOrFail(3)){
            $price = $sandwich_obj->price;
        }else{
            return ['success' => false, 'message' => "Errore nell'ordinazione"];
        }

        // Check if the sandwich was already ordered by the school class
        // in the same day.            
        $order = \DB::table('orders')->where('user_id', '=', 4)
                                    ->where('sandwich_id', '=', 3)
                                    ->whereDate('created_at', '=', Carbon::today()->toDateString())
                                    ->whereNull('deleted_at');
        if($order->exists()){
            $times = ($order->select('times')->pluck('times')[0]);
            if($times > 1){
                $order->updated_at = Carbon::now(); 
                $order->update(['times' => $times - 1]);
                return ['success' => true, 'message' => 'Diminuzione effettuata.'];   
            }else{
                try {
                    $order->delete();
                    return ['success' => true, 'message' => 'Rimozione effettuata.'];

                } catch (\Throwable $th) {
                    return ['success' => false, 'message' => $th->getMessage()];
            }
        }
        // Otherwise
        }else{
            return ['success' => false, 'message' => 'Panino non trovato.'];
        }      
    }
}
