@extends('layouts.app')

@section('content')

    <div class="container menu" style="margin-top: 80px; margin-bottom: 80px; padding-bottom: 2%;">
        <hr>
        <h1>L'applicazione è stata creata da:</h1>
        <br>
        <ul>
            <li onclick="lol('a')" id="lolink">Ambrosi Marco</li>
            <li onclick="lol('d')" id="lolink">Du Haowei</li>
            <li onclick="lol('l')" id="lolink">Lorenzoni Luca</li>
        </ul>
        <br>
        <i id="lol" class="none"></i>

    
        <h2 class="mt-3">Bon Appétit!</h2>
    </div>

    <script type="application/javascript">
        function lol(l){
            var link;
            switch (l) {
                case "d":
                    link = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';
                break;
                case "a":
                    link = 'https://www.youtube.com/watch?v=z_HWtzUHm6s';
                break;
                case "l":
                    link = 'https://www.youtube.com/watch?v=WU0cGmmL374';
                break;
                default:
                    link = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';
                break;
            };
            $.ajax({  
                    type: "GET",                    
                    url: "api/settings/egg",  
                    data: { 
                        api_token: '{{ Auth::user()->api_token }}',
                        _token: '{{csrf_token()}}',
                    },
                    dataType: "json",
                    success: function(risposta) {  
                        window.open(link, '_blank');
                        $("#lol").html("Numero di persone che ci sono cascate: " + risposta);
                        $("#lol").slideDown("slow");
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
        }
    </script>

@endsection
