<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    private $logged_user;
    private $user_id;

    public function __construct(Request $request){
        // Utente che fa la chiamata api
        $this->logged_user = $request->user('api');
        // Id dell'utente su cui agire
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
        $this->authorize('view-any', User::class);
        $users = User::withTrashed()->get();
        foreach ($users as $user) {
            if($user->trashed()){
                $user->setAttribute('trashed', 'true');
            } else {
                $user->setAttribute('trashed', 'false');
            }
        }

        return view('/users/index')->with(compact('users'));
    }

    /**
     * Send a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_api()
    {
        if($this->logged_user->can('view-any', User::class)){
            $users = User::all();
            return $users;
        }else{
            return response()->json(['message' => "Errore nell'operazione. Utente non autorizzato."], 401);
        }
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
    public function store_api(UserRequest $request)
    {
        if($this->logged_user->can('create', User::class)){
            try {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = \Hash::make($request->password);
                $user->api_token = \Str::random(60);
                $user->role = $request->role;
                $user->save();
                return response()->json(['message' => 'Utente creato'], 200);
            } catch (\Throwable $th) {
                return response()->json(['message' => "Errore nell'operazione. Ricontrollare i dati inseriti (l'utente o un dato 'unico' potrebbero essere già presenti)."], 200);
            }
        }else{
            return response()->json(['message' => "Errore nell'operazione. Utente non autorizzato."], 401);
        }
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
        $user = User::findOrFail($id);
        //dd(Auth::user()->name, $user->name);
        $this->authorize('update', $user);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->role = $request->get('role');
        if ($request->has('password')) {
            $user->password = \Hash::make($request->get('password'));
        }
        $user->save();
        return redirect('users')->withSuccess('Utente aggiornato.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_api(UserRequest $request)
    {
        $user = User::findOrFail($user_id);
        if($this->logged_user->can('update', $user)){
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            if ($logged_user->role == 'admin') {
                $user->role = $request->get('role');
            }
            if ($request->has('password')) {
                $user->password = \Hash::make($request->get('password'));
            }
            $user->save();
            return response()->json(['success' => $result], 200);
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
    public function destroy_api($id)
    {        
        $user = User::findOrFail($id);
        if($this->logged_user->can('delete', $user)){
            $user->forceDelete();
            return response()->json(['message' => 'Eliminazione effettuata.'], 200);
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
    public function soft_destroy_api($id)
    {        
        $user = User::findOrFail($id);
        if($this->logged_user->can('delete', $user)){
            $user->delete();
            return response()->json(['message' => 'Eliminazione effettuata.'], 200);
        }else{
            return response()->json(['message' => "Errore nell'operazione. Utente non autorizzato."], 401);
        }
    }
}
