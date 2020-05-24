@extends('layouts.app')

@section('content')

@can('order', App\Order::class)
<!-- Container with the list of sandwiches -->
<div class="container bg-white" style="margin-top: 80px; margin-bottom: 80px; padding-bottom: 2%;">
    <div class="row">
        <div class="col">
            <br>
            <!-- Three main buttons -->
            <div class="btn-toolbar" role="toolbar">
                <div class="dropdown">
                    <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                        Ordina per:
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" onclick="sorting('1')">Nome crescente</a>
                        <a class="dropdown-item" href="#" onclick="sorting('2')">Nome decrescente</a>
                        <a class="dropdown-item" href="#" onclick="sorting('3')">Prezzo crescente</a>
                        <a class="dropdown-item" href="#" onclick="sorting('4')">Prezzo decrescente</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                        Visualizza panini:
                    </button>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" onclick="filtering('tutti')">Tutti</a>
                        <a class="dropdown-item" href="#" onclick="filtering('caldi')">Caldi</a>
                        <a class="dropdown-item" href="#" onclick="filtering('freddi')">Freddi</a>
                    </div>
                </div>
            </div>
            <hr>
            <h1>Ordina i tuoi panini!</h1>
            <br>
            <div id="reloadSandwiches">

            </div>
        </div>


        <!-- Seconda colonna / ripeilogo ordine -->
        <div class="col ml-5">
            <br>
            <!-- Three main buttons -->
            <div class="btn-toolbar" role="toolbar">
                <div class="dropdown">
                    <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                        Ordina per:
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" onclick="sorting('1')">Nome crescente</a>
                        <a class="dropdown-item" href="#" onclick="sorting('2')">Nome decrescente</a>
                        <a class="dropdown-item" href="#" onclick="sorting('3')">Prezzo crescente</a>
                        <a class="dropdown-item" href="#" onclick="sorting('4')">Prezzo decrescente</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                        Visualizza panini:
                    </button>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" onclick="filtering('tutti')">Tutti</a>
                        <a class="dropdown-item" href="#" onclick="filtering('caldi')">Caldi</a>
                        <a class="dropdown-item" href="#" onclick="filtering('freddi')">Freddi</a>
                    </div>
                </div>
            </div>
            <hr>
            <h1>Riepilogo ordinazioni</h1>
            <br>

        </div>
    </div>


    <hr>

    <footer class="footer">
        <div class="container bg-white text-center">
            <span class="text-muted">&COPY 2020 All right reserved | Lorenzoni - Ambrosi - Du | Al Bar Poldo</span>
            <!-- Scroll-back button -->
            <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>
        </div>
    </footer>

</div>

<!-- Footer
<footer class="footer">
    <span class="text-muted text-center">&COPY; 2020 | Lorenzoni - Ambrosi - Du | Al Bar Poldo</a>
        <!-- Scroll-back button 
        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>
</footer> -->



<div>
    <script type="application/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script type="application/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

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
    function addSandwich(id) {
        $.ajax({
            type: "POST",
            url: "/api/order",
            data: {
                api_token: '{{ Auth::user()->api_token }}',
                sandwich_id: id,
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
    }

    function removeSandwich(id) {
        $.ajax({
            type: "POST",
            url: "/api/order",
            data: {
                api_token: '{{ Auth::user()->api_token }}',
                sandwich_id: id,
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
    }
</script>


<script type="application/javascript">
    var list = [
        @foreach($sandwiches as $sandwich => $attributes) {
            id: '{{$attributes->id}}',
            nome: '{{$attributes->name}}',
            prezzo: '{{$attributes->price}}',
            ingredienti: '{{$attributes->description}}',
            stato: '{{$attributes->type}}'
        },
        @endforeach
    ];

    var sort = "1";
    var filter = "tutti";
    var final_list = list;
    $(document).ready(function() {
        filtering(filter);
    })

    function sorting(value) {
        sort = value;
        let string = "";
        switch (sort) {
            case "1":
                final_list = final_list.sort((a, b) => {
                    return a.nome.localeCompare(b.nome);
                });
                break;
            case "2":
                final_list = final_list.sort((a, b) => {
                    return b.nome.localeCompare(a.nome);
                });
                break;
            case "3":
                final_list = final_list.sort((a, b) => {
                    return a.prezzo - b.prezzo;
                });
                break;
            case "4":
                final_list = final_list.sort((a, b) => {
                    return b.prezzo - a.prezzo;
                });
                break;
            default:
                final_list = final_list.sort((a, b) => {
                    return a.nome.localeCompare(b.nome);
                });
                break;
        }
        final_list.forEach(function(item) {
            string +=
                `<div class="media p-1">
            <img src="./img/pan1.jpg" class="media-object" style="width:65px; height:65px">
            <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
            <h4 class="media-heading">` + item.nome + `: ` + item.prezzo + `€</h4>
            <div class="input-group">
                <input hidden class="sandwich_id" name="sandwich_id" value="` + item.id + `">
                <input hidden class="price" name="price" value="` + item.prezzo + `">
                <input disabled value="` + item.ingredienti + `" type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="plus btn btn-success" type="button" onclick="addSandwich(` + item.id + `)"><i class="fa fa-plus"></i></button>
                    <button class="minus btn btn-danger" type="button" onclick="removeSandwich(` + item.id + `)"><i class="fa fa-minus"></i></button>
                </div>
            </div>
        </div>
            </div>`;
        });
        $("#reloadSandwiches").html(string);
    };

    function filtering(value) {

        filter = value;
        switch (filter) {
            case "tutti":
                final_list = list;
                break;
            case "caldi":
                final_list = list.filter((a) => {
                    return a.stato === "Caldo";
                });
                break;
            case "freddi":
                final_list = list.filter((a) => {
                    return a.stato === "Freddo";
                });
                break;
            default:
                final_list = list;
                break;
        };
        sorting(sort);
    }
</script>



@endsection