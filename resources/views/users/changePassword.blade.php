@extends('layouts.app')

@section('content')

        <div class="container bg-white" style="margin-top: 80px; margin-bottom: 80px; padding-bottom: 2%;">

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

        <!-- Scroll-back button -->
        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>
    
        <!-- Footer -->
        <footer class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">&COPY; 2020 | Lorenzoni - Ambrosi - Du | Al Bar Poldo</a>
        </footer>
        <div>

    
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
        </div>
@endsection
