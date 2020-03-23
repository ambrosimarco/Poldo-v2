<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sandwich;

class SandwichController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sandwiches = Sandwich::all();

        return view('/sandwiches/view')->with(compact('sandwiches'));
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
        // E' NECESSARIO METTERE IL SITO IN MANUTENZIONE?
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // E' NECESSARIO METTERE IL SITO IN MANUTENZIONE
        // BISOGNA ANCHE AGGIORNARE OGNI RECORD DI QUEL PANINO NEL GIORNO ATTUALE NELLA TABELLA DEGLI ORDINI
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // E' NECESSARIO METTERE IL SITO IN MANUTENZIONE
    }
}
