<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view-any', User::class);
        $users = User::all();
        return view('/users/index')->with(compact('users'));
    }

    /**
     * Send a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_api()
    {
        $this->authorize('view-any', User::class);
        $users = User::all();
        return $users;
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
     * @param  \Illuminate\Http\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('view', $user);
        return view('/users/show')->with(compact('user'));
    }

    /**
     * Show the form for editing the password.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('change-password', $user);
        return view('/users/change.password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        dd('update function');
        $this->authorize('update', User::class);
        $user = User::findOrFail($id);
        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        $user->isAdmin = $request->get('isAdmin');
        $user->canOrder = $request->get('isCustomer');
        $user->save();
        return redirectTo("google.com");
        return redirect()->back()->withSuccess('Utente aggiornato.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_api(UserRequest $request, $id)
    {
        $this->authorize('update', User::class);
        $user = User::findOrFail($id);
        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        $user->isAdmin = $request->get('isAdmin');
        $user->canOrder = $request->get('isCustomer');
        $user->save();
        return response()->json(['success' => $result], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
