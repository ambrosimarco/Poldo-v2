@extends('layouts.app')

@section('content')


        <!-- Container with the list of users -->
        <div class="container bg-white" style="margin-top: 80px; margin-bottom: 80px; padding-bottom: 2%;">
    
            <hr>

            <h1>Liste di oggi</h1>
            <br />
            @foreach($customers as $customer => $attributes)
                <div class="media p-1">
                    <img src="./img/pan1.jpg" class="media-object" style="width:65px; height:65px">
                    <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
                    <h4 class="media-heading">{{$attributes->name}}</h4>
                        <div class="input-group">
                            <div class="input-group-append">
                            <button type="button" class="btn btn-primary mr-1" onclick="getList({{$attributes->id}})">Vedi</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            <div class='none' id='{{$attributes->id}}'></div>

            @endforeach

        <script type="application/javascript">
            function getList(id){
                    $.ajax({  
                        type: "GET",
                        url: "/api/order/list/" + id,  
                        data: {
                            api_token: '{{ Auth::user()->api_token }}',
                        },
                        dataType: "json",
                        success: function(risposta) {                             
                            let string = '';
                            let tot = 0;
                            risposta.forEach(element => {                               
                                string += '<tr>'
                                string += '<td class="">' + element.name + '</td>';
                                string += '<td>' + element.price + '</td>';
                                string += '<td>' + element.pivot.times + '</td>';
                                string += '<td>' + (element.price * element.pivot.times).toFixed(2) + '</td>';
                                string += '</tr>'
                                tot += element.price * element.pivot.times;
                            });

                            $("#"+id).html(`
                                <div class='card' style='width: 18rem; '>
                                    <div class='card-body'>
                                        <h5 class='card-title'>Ordinazioni</h5>
                                        <p class='card-text'>
                                            <table>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Prezzo</th>
                                                    <th>Numero</th>
                                                    <th>Totale</th>
                                                </tr>
                                                ` + string + `
                                                <tr>
                                                    <td>TOTALE</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>` + tot.toFixed(2) + `</td>
                                                </tr>
                                        </p>
                                    </div>
                                </div>  
                                `);
                            let displ = $("#"+id).is( ":hidden" );
                            if (displ){
                                $("#"+id).slideDown("slow");
                            }else{
                                $("#"+id).slideUp();
                            }
                        },
                        error: function(xhr, status, error) {
                        alert(xhr.responseText);
                        }
                    }); 
            }
        </script>

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
