@extends('layouts.app')

@section('content')

    <form id="form" action="{{ route('users.update', $user->id) }}" method="POST">
        @method('PATCH')
        <h1>Nome:</h1>
        <input class="field" value="{{$user->name}}" id="name" name="name">
        <h1>E-mail:</h1>
        <input class="field" value="{{$user->email}}" id="email" name="email">
        <h1>Ruolo:</h1>
        <select class="field" id="role" name="role">
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Amministratore</option> 
            <option value="class" {{ $user->role=='class' ? 'selected' : ''}}>Classe</option> 
            <option value="bar" {{$user->role=='bar' ? 'selected' : ''}}>Bar</option>
        </select>
        <h1>Password:</h1>
        <p>(lasciare vuoto per non modificare)</p>
        <input class="field" type="password" value ="" id="password" name="password">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        @can('update', Auth::user(), $user)
        <br />
        <div id="buttons-container">
            <button id="edit" type="button" onclick="editForm()" class="btn btn-primary mt-3">Modifica</button>
            <button id="send" type="submit" class="btn btn-primary mt-3">Invia</button>
        </div>
        @endcan
    </form>

        <script  type="application/javascript">
            function editForm(){
                
            }
        </script>

    

        <div>

    

@endsection
