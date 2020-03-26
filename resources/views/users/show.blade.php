@extends('layouts.app')

@section('content')

<form id="form" action="{{ $user->id }}" method="POST">
        {{ method_field('PUT') }}
        <h1>Nome:</h1>
        <input class="field" value="{{$user->name}}" id="name" name="name">
        <h1>E-mail:</h1>
        <input class="field" value="{{$user->email}}" id="email" name="email">
        <h1>Ruolo:</h1>
        <select class="field" id="role" name="role">
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Amministratore</option> 
            <option value="class" {{ $user->role=='class' ? 'selected' : ''}}>Classe</option> 
            <option value="observer" {{$user->role=='observer' ? 'selected' : ''}}>Osservatore</option>
        </select>
        <input type="hidden" value="{{ csrf_token() }}" name="_token">
        @can('update', App\User::class)
        <br />
        <div id="buttons-container">
            <button id="edit" type="button" onclick="editForm()" class="btn btn-primary mt-3">Modifica</button>
            <button id="send" type="submit" class="btn btn-primary mt-3">Invia</button>
        </div>
        @endcan

        <script  type="application/javascript">
            function editForm(){
                
            }
        </script>
</form>
    
        <!-- Footer -->
        <footer class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">&COPY; 2020 | Lorenzoni - Ambrosi - Du | Al Bar Poldo</a>
        </footer>
        <div>
        <script type="application/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script type="application/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script type="application/javascript" src="/js/bootstrap-better-nav.js"></script>
    
        <script  type="application/javascript">
            //Get the button
            var mybutton = document.getElementById("myBtn");
    
            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function () {
                scrollFunction()
            };
    
            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    mybutton.style.display = "block";
                } else {
                    mybutton.style.display = "none";
                }
            }
    
            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
    
        </script>
        </div>
@endsection
