@extends('layouts.app')

@section('content')

@can('order', App\Order::class)
<!-- Container with the list of sandwiches -->
<div class="container bg-white" style="margin-top: 80px; margin-bottom: 80px; padding-bottom: 2%;">
    <!-- Three main buttons -->
    <div class="btn-toolbar pt-4" role="toolbar">
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

    @foreach($sandwiches as $sandwich => $attributes)
    @php
    $recipe = "";
    @endphp
    @foreach($attributes->ingredients as $ingredient)
    @php
    $recipe = $recipe.$ingredient->name;
    @endphp
    @if (!$loop->last)
    @php
    $recipe = $recipe.", ";
    @endphp
    @endif
    @endforeach

    <div class="media p-1">
        <img src="./img/pan1.jpg" class="media-object" style="width:65px; height:65px">
        <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
            <h4 class="media-heading">{{$attributes->name}}: {{$attributes->price}}€</h4>
            <div class="input-group">
                <input hidden class="sandwich_id" name="sandwich_id" value="{{$attributes->id}}">
                <input hidden class="price" name="price" value="{{$attributes->price}}">
                <input disabled value="{{$recipe}}" type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="plus btn btn-success" type="button" onclick="addSandwich(this)"><i class="fa fa-plus"></i></button>
                    <button class="minus btn btn-danger" type="button" onclick="removeSandwich(this)"><i class="fa fa-minus"></i></button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <hr>

    <!-- Footer -->
    <footer class="navbar navbar-light bg-light">
        <a class="navbar-brand text-center" href="#">&COPY; 2020 | Lorenzoni - Ambrosi - Du | Al Bar Poldo</a>
        <!-- Scroll-back button -->
        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>
    </footer>
</div>



<div>
    <script type="application/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script type="application/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="application/javascript" src="js/bootstrap-better-nav.js"></script>

    <script type="application/javascript">
        //Get the button
        var mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
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
@else
<h1>Benvenuto, {{ Auth::user()->name }}!</h1>
@endcan

<script type="application/javascript">
    function addSandwich(button) {
        $(button).on('click', function() {
            var sandwich_id = $($(this).parent().parent()[0]).find("input")[0].value;
            var price = $(this).parent().parent().parent();
            $.ajax({
                type: "POST",
                url: "/api/order",
                data: {
                    api_token: '{{ Auth::user()->api_token }}',
                    sandwich_id: 3,
                    _token: '{{csrf_token()}}',
                    _method: 'PUT'
                },
                dataType: "json",
                success: function(risposta) {
                    alert(risposta.message);
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        });
    }

    function removeSandwich(button) {
        $(button).on('click', function() {
            var sandwich_id = $($(this).parent().parent()[0]).find("input")[0].value;
            var price = $(this).parent().parent().parent();
            $.ajax({
                type: "POST",
                url: "/api/order",
                data: {
                    api_token: '{{ Auth::user()->api_token }}',
                    sandwich_id: 3,
                    _token: '{{csrf_token()}}',
                    _method: 'DELETE'
                },
                dataType: "json",
                success: function(risposta) {
                    alert(risposta.message);
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        });
    }
</script>
@endsection