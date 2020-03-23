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
     * @param  \Illuminate\Http\Request  $request
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
        try {
            
            $order = \DB::table('orders')->where('user_id', '=', $request->get('user_id'))
                                ->where('sandwich_id', '=', $request->get('sandwich_id'))
                                ->whereDate('created_at', '=', Carbon::today()->toDateString())->update(['times' => '5']);
    
            return ['success' => true, 'message' => 'rft'];   
        //}catch(\Throwable $th){return ['success' => true, 'message' => $th->getMessage()];   }

        // Otherwise
        }catch(\Throwable $th){
            try {
                $price = Sandwich::findOrFail($request->get('sandwich_id'))->price;
                \DB::table('orders')->insert([
                    'user_id' => $request->get('user_id'),
                    'sandwich_id' => $request->get('sandwich_id'),
                    'price' => $price,
                    'times' => '1',
                ]);
                return ['success' => true, 'message' => 'Nuovo ordine creato'];

            } catch (\Throwable $th) {
                return ['success' => false, 'message' => 'Creazione ordine fallita'];
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
        //
    }
}
