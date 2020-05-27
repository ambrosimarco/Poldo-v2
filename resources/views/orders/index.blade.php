@extends('layouts.app')

@section('content')


        <!-- Container with the list of users -->
        <div class="container menu" style="margin-top: 80px; margin-bottom: 80px; padding-bottom: 2%;">
    
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
            <div class='none' id='{{$attributes->id}}'>
            </div>

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


    


    

        </div>
@endsection
