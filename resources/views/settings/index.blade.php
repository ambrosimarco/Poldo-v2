@extends('layouts.app')

@section('content')

        <!-- Container with the list of sandwiches -->
        <div class="container bg-white" style="margin-top: 80px; margin-bottom: 80px; padding-bottom: 2%;">
    
        

        <!-- Scroll-back button -->
        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>
    
        <!-- Footer -->
        <footer class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">&COPY; 2020 | Lorenzoni - Ambrosi - Du | Al Bar Poldo</a>
        </footer>
        <div>
        <script type="application/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script type="application/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script type="application/javascript" src="js/bootstrap-better-nav.js"></script>
    
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
