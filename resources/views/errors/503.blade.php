@extends('layouts.app')

@section('content')
        
        <h1>ERRORE 503</h1>
        <br>
        <h2>{{ $exception->getMessage() }}</h2>
@endsection
