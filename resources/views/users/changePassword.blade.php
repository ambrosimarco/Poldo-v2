@extends('layouts.app')

@section('content')

        <div class="container menu" style="margin-top: 80px; margin-bottom: 80px; padding-bottom: 2%;">

        <hr>
        <h1>Cambio password</h1>
        <br />

        <form method="POST" action="{{ route('updateSettings') }}">           
            @method('PATCH')
            <label>
                <input class="input-group-text" type="password" name="old_password">
                <span>Vecchia password</span>
            </label>
            <label>
                <input class="input-group-text" type="password" name="new_password">
                <span>Nuova password</span>
            </label>
                <input class="input-group-text" type="password" name="new_password_confirmation">
                <span>Reinserisci la password</span>
            </label>
            <br />
            <br />
            <button class="btn btn-primary" type="submit">Invia</button>
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <input name="id" type="hidden" value="{{ Auth::user()->id }}"/>
          </form>  


    

        <div>

    

        </div>
        </div>
@endsection
