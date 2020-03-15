@extends('layouts.app')

@section('content')

        <!-- Container with the list of sandwiches -->
        <div class="container bg-white" style="margin-top: 80px; margin-bottom: 80px; padding-bottom: 2%;">
    
            <!-- Three main buttons -->
            <div class="btn-toolbar" role="toolbar">
                <div class="dropdown">
                    <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                        Ordina per:
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Nome crescente</a>
                        <a class="dropdown-item" href="#">Nome decrescente</a>
                        <a class="dropdown-item" href="#">Prezzo crescente</a>
                        <a class="dropdown-item" href="#">Prezzo decrescente</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                        Visualizza panini:
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Caldi</a>
                        <a class="dropdown-item" href="#">Freddi</a>
                    </div>
                </div>
            </div>
            <hr>
    
            <div class="media p-1">
                <img src="./img/pan1.jpg" class="media-object" style="width:65px; height:65px">
                <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
                    <h4 class="media-heading">Farcito con prosciutto cotto e salsa ai funghi: 1.40€</h4>
                    <div class="input-group">
                        <input disabled value="Pane, prosciutto cotto, salsa ai funghi" type="text" class="form-control"
                            aria-label="Recipient's username" aria-describedby="basic-addon2">
    
                        <div class="input-group-append">
                            <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
                            <button type="button" class="btn btn-danger"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="media p-1">
                <img src="./img/pan1.jpg" class="media-object" style="width:65px; height:65px">
                <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
                    <h4 class="media-heading">Caprese: 1.40€</h4>
                    <p><b> Ingredienti:</b> Pane, insalata, mozzarella, pomodori</p>
                </div>
            </div>
    
            <div class="media p-1">
                <img src="./img/pan1.jpg" class="media-object" style="width:65px; height:65px">
                <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
                    <h4 class="media-heading">Filoncino: 1.40€</h4>
                    <p><b> Ingredienti:</b> Pane, prosciutto crudo</p>
                </div>
            </div>
    
            <div class="media p-1">
                <img src="./img/pan1.jpg" class="media-object" style="width:65px; height:65px">
                <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
                    <h4 class="media-heading">Verona: 1.40€</h4>
                    <p><b> Ingredienti:</b> Pane, pancetta, formaggio, salsa al radicchio</p>
                </div>
            </div>
    
            <div class="media p-1">
                <img src="./img/pan1.jpg" class="media-object" style="width:65px; height:65px">
                <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
                    <h4 class="media-heading">Brioches alla crema: 0.70€</h4>
                    <p><b> Ingredienti:</b> Soffice cornetto ripieno di crema</p>
                </div>
            </div>
    
            <div class="media p-1">
                <img src="./img/pan1.jpg" class="media-object" style="width:65px; height:65px">
                <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
                    <h4 class="media-heading">Brioches alla marmellata: 0.70€</h4>
                    <p><b> Ingredienti:</b> Soffice cornetto ripieno di marmellata</p>
                </div>
            </div>
    
            <div class="media p-1">
                <img src="./img/pan1.jpg" class="media-object" style="width:65px; height:65px">
                <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
                    <h4 class="media-heading">Brioches alla cioccolata: 0.70€</h4>
                    <p><b> Ingredienti:</b> Soffice cornetto ripieno di ciocciolato</p>
                </div>
            </div>
    
            <div class="media p-1">
                <img src="./img/pan1.jpg" class="media-object" style="width:65px; height:65px">
                <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
                    <h4 class="media-heading">Focaccia con prosciutto cotto: 1.30€</h4>
                    <p><b> Ingredienti:</b> Pane, prosciutto cotto</p>
                </div>
            </div>
    
            <div class="media p-1">
                <img src="./img/pan1.jpg" class="media-object" style="width:65px; height:65px">
                <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
                    <h4 class="media-heading">Farcito piccante: 1.40€</h4>
                    <p><b> Ingredienti:</b> Pane, formaggio, salsa piccante</p>
                </div>
            </div>
            <hr>
        </div>
    
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
