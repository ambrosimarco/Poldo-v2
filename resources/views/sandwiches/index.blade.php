@extends('layouts.app')

@section('content')

<!-- Container with the list of sandwiches -->
<div class="container bg-white" style="margin-top: 80px; margin-bottom: 80px; padding-bottom: 2%;">

    <hr>
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

    <h1 class="mb-3">Panini</h1>
    <div id="reloadForm">
        <div id="reloadSandwiches">
            @foreach($sandwiches as $sandwich => $attributes)
            @php
            $recipe = "";
            @endphp
            {{--@foreach($attributes->ingredients as $ingredient)
                        @php
                        $recipe = $recipe.$ingredient->name;
                        @endphp
                        @if (!$loop->last)
                            @php
                            $recipe = $recipe.", "; --}} {{-- Ingredienti del panino --}} {{--
                            @endphp
                        @endif
                    @endforeach --}}
            <div class="media p-1">
                <img src="./img/pan1.jpg" class="media-object rounded-circle mt-1" style="width:65px; height:65px">
                <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
                    <h4 class="media-heading">{{$attributes->name}}: {{$attributes->price}}€</h4>
                    <div class="input-group">
                        <input disabled value="{{$attributes->description}}" type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                        </div>
                        <button type="button" class="btn btn-primary mr-1" onclick="deleteSandwich({{$attributes->id}})">Elimina</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-primary mr-1" onclick="showForm()">Nuovo</button>
        <div class='none' id='new'>
            <div class='card' style='width: 18rem;'>
                <div class='card-body'>
                    <h5 class='card-title'>Ordinazioni</h5>
                    <p class='card-text'>
                        <label for="name">Nome</label>
                        <input type="text" class="border border-dark" id="name">
                        <label for="price">Prezzo</label>
                        <input type="text" class="border border-dark" id="price">
                        <label for="description">Descrizione</label>
                        <input type="text" class="border border-dark" id="description">
                        <br>
                        <label for="type">Tipo</label>
                        <select class="field" id="type">
                            <option value="Caldo">Caldo</option>
                            <option value="Freddo">Freddo</option>
                        </select>
                        <br>
                        <button type="button" class="btn btn-primary mr-1" onclick="createSandwich()">Invia</button>
                    </p>
                </div>
            </div>
        </div>
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



        <script type="application/javascript">
            function showForm() {
                let displ = $("#new").is(":hidden");
                if (displ) {
                    $("#new").slideDown("slow");
                } else {
                    $("#new").slideUp();
                }
            }

            function createSandwich(button) {
                var name = $('#name').val();
                var price = $('#price').val();
                var description = $('#description').val();
                var type = $('#type').val();
                $.ajax({
                    type: "POST",
                    url: "/api/sandwiches",
                    data: {
                        api_token: '{{ Auth::user()->api_token }}',
                        name: name,
                        price: price,
                        description: description,
                        type: type,
                        _token: '{{csrf_token()}}',
                    },
                    dataType: "json",
                    success: function(risposta) {
                        alert(risposta.message);
                        $("#reloadForm").load(location.href + " #reloadForm");
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            }

            function deleteSandwich(id) {
                $.ajax({
                    type: "POST",
                    url: "/api/sandwiches/" + id,
                    data: {
                        api_token: '{{ Auth::user()->api_token }}',
                        _token: '{{csrf_token()}}',
                        _method: 'DELETE'
                    },
                    dataType: "json",
                    success: function(risposta) {
                        alert(risposta.message);
                        $("#reloadSandwiches").load(location.href + " #reloadSandwiches");
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
                    id: {
                        {
                            $attributes - > id
                        }
                    },
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
                        <img src="./img/pan1.jpg" class="media-object rounded-circle mt-1" style="width:65px; height:65px">
                        <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
                        <h4 class="media-heading">` + item.nome + `: ` + item.prezzo + `€</h4>
                            <div class="input-group">
                                <input disabled value="` + item.ingredienti + `" type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                </div>
                                <button type="button" class="btn btn-primary mr-1" onclick="deleteSandwich(` + item.id + `)">Elimina</button>                                
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
    @endsection