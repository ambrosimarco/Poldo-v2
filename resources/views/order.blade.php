@extends('layouts.app')

@section('content')

@can('order', App\Order::class)
<!-- Container with the list of sandwiches -->

    <div class="container bg-white mt-5 mb-3">
        <div class=" row">
            <div class="col">
                <br>
                <!-- Two main buttons -->
                <div class="btn-toolbar pb-2" role="toolbar">
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
                <h2>Ordina i tuoi panini!</h2>
                <br>

                <!-- Barra di ricerca -->
                <div class="wrap-input100">
                    <span class="btn-show-pass">
                        <i class="fa fa-search"></i>
                    </span>
                    <input class="input100" type="text" id="search" placeholder="Cerca panini">
                    <span class="focus-input100"></span>
                </div>

                <!-- Elenco panini -->
                <div id="reloadSandwiches" class="overflow-auto" style="height: 500px">
                </div>
            </div>


            <!-- Seconda colonna / ripeilogo ordine -->
            <div class="col ml-5">
                <br>
                <!-- titolo del riepilogo -->
                <div class="title">
                    Al Bar Poldo
                    <br>
                    {{ now()}} - {{Auth::user()->name}}
                </div>
                <hr>
                <h2>Riepilogo ordinazioni</h2>
                <br>
                <div id="riepilogo">

                </div>
            </div>
        </div>


        <hr>

       

    </div>


<!-- Footer
<footer class="footer">
    <span class="text-muted text-center">&COPY; 2020 | Lorenzoni - Ambrosi - Du | Al Bar Poldo</a>
        <!-- Scroll-back button 
        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>
</footer> -->





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

@else
<div class="container bg-white" style="margin-top: 80px; margin-bottom: 80px; padding-bottom: 2%;">
    <div class="row">
        <h1 class="mt-3 ml-3 text-center">Benvenuto, {{ Auth::user()->name }}!</h1>
    </div>
    <div class="row">
        <canvas id="myChart" style=" background: transparent url(img/burger.png) no-repeat center 175px"></canvas>
    </div>
</div>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    @if(Auth::user() -> role == 'admin')
    var labels = ['Gestione utenti', 'Ordinazioni', 'Listino', 'Stampa liste', 'Gestione Poldo', 'Contatti'];
    @elseif(Auth::user() -> role == 'bar')
    var labels = ['Ordinazioni', 'Listino', 'Stampa liste', 'Gestione Poldo', 'Contatti'];
    @endif
    var labelsColor = ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)", "rgb(219, 0, 208)", "rgb(88, 219, 0)", "rgb(47, 0, 219)"];
    var data = [];
    for (i = 0; i < labels.length; i++) {
        data.push(1);
    }

    data = {
        datasets: [{
            data: data,
            backgroundColor: labelsColor,
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: labels
    };

    // And for a doughnut chart
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
            legend: {
                display: false,
            },
            responsive: true,
            elements: {
                arc: {
                    borderWidth: 30,
                    borderColor: 'rgba(0, 0, 0, 0)',
                },
            },
            tooltips: {
                enabled: false
            },
            plugins: {
                datalabels: {
                    color: '#111',
                    textAlign: 'center',
                    font: {
                        lineHeight: 1.6,
                        size: 18,
                    },
                    formatter: function(value, ctx) {
                        return ctx.chart.data.labels[ctx.dataIndex];
                    }
                }
            }
        }
    });

    document.getElementById("myChart").onclick = function(evt) {
        var activePoints = myDoughnutChart.getElementsAtEvent(evt);
        var firstPoint = activePoints[0];
        var label = myDoughnutChart.data.labels[firstPoint._index];
        switch (label) {
            // add case for each label/slice
            case 'Gestione utenti':
                window.open('/users', "_self");
                break;
            case 'Contatti':
                window.open('/contacts', "_self");
                break;
                // add rests ...
        }
    };
</script>
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
                // alert(risposta.message);
                riepilogo();
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
                // alert(risposta.message);
                riepilogo();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }

    function riepilogo() {
        $.ajax({
            type: "GET",
            url: "api/order/list/{{Auth::user()->id}}",
            data: {
                api_token: '{{ Auth::user()->api_token }}',
                _token: '{{csrf_token()}}',
                _method: 'DELETE'
            },
            dataType: "json",
            success: function(risposta) {
                var tot = 0.00;
                var string = "";
                string += `
                <table class="table">
                    <tr>
                        <th>Nome</th>
                        <th class="text-center">Quantità</th>
                        <th>Prezzo</th>
                    </tr>
                `;
                risposta.forEach(element => {
                    string += `
                    <tr>
                        <td>` + element.name + `</td>
                        <td class="text-center">` + element.pivot.times + `</td>
                        <td>` + element.pivot.price + ` €</td>
                    </tr>
                    `;
                    tot += element.pivot.price * element.pivot.times;
                });
                string += `
                    <tr>
                        <td class="mt-3">TOTALE</td>
                        <td></td>
                        <td>` + tot.toFixed(2) + ` €</td>
                    </tr>
                    `;
                string += '</table>';


                $("#riepilogo").html(string);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }

    $(document).ready(function() {
        riepilogo();
    });
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
    var search_list = list;
    var sear = "";
    $(document).ready(function() {
        $('#search').keyup(function() {
            this.sear = $("#search").val();
            if (this.sear === "") {
                search_list = list;
            } else {
                search_list = list.filter((a) => {
                    return a.nome.toLocaleLowerCase().includes(this.sear.toLocaleLowerCase());
                });
            }
            filtering(filter);
        });
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
                `<div class="media my-2 p-1">
                    <img src="./img/pan1.jpg" class="media-object rounded-circle mt-1" style="width:70px; height:70px">
                    <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
                        <h4 class="media-heading">` + item.nome + `: ` + item.prezzo + `€</h4>
                        <div class="input-group pt-1">
                            <input hidden class="sandwich_id" name="sandwich_id" value="` + item.id + `">
                            <input hidden class="price" name="price" value="` + item.prezzo + `">
                            <input disabled value="` + item.ingredienti + `" type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="plus btn btn-outline-success rounded" type="button" onclick="addSandwich(` + item.id + `)"><i class="fa fa-plus"></i></button>
                                <button class="minus btn btn-outline-danger rounded" type="button" onclick="removeSandwich(` + item.id + `)"><i class="fa fa-minus"></i></button>
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
                final_list = search_list;
                break;
            case "caldi":
                final_list = search_list.filter((a) => {
                    return a.stato === "Caldo";
                });
                break;
            case "freddi":
                final_list = search_list.filter((a) => {
                    return a.stato === "Freddo";
                });
                break;
            default:
                final_list = search_list;
                break;
        };
        sorting(sort);
    }
</script>



@endsection