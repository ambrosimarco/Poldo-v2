@extends('layouts.app')

@section('content')

        <!-- Container with the list of users -->
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
    
            @foreach($users as $user => $attributes)
                <div class="media p-1">
                    <img src="./img/pan1.jpg" class="media-object" style="width:65px; height:65px">
                    <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
                    <h4 class="media-heading">{{$attributes->name}}</h4>
                        <div class="input-group">
                            <div class="input-group-append">
                            <button type="button" class="btn btn-primary mr-1"><a href="/users/{{$attributes->id}}">Vedi</a></button>
                            <button type="button" class="btn btn-primary mr-1" onclick="deleteUser({{$attributes->id}})">Cancella</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <button type="button" class="btn btn-primary mr-1" onclick="showForm()">Nuovo</button>
            <div class='none' id='new'>
                <div class='card' style='width: 18rem;'>
                    <div class='card-body'>
                        <h5 class='card-title'>Ordinazioni</h5>
                        <p class='card-text'>
                            <label for="name">Nome</label>
                            <input type="text" class="border border-dark" id="name">
                            <label for="email">Email</label>
                            <input type="text" class="border border-dark" id="email">
                            <label for="password">Password</label>
                            <input type="password" class="border border-dark" id="password">
                            <label for="password">Ruolo</label>
                            <select class="field" id="role">
                                <option value="admin">Amministratore</option> 
                                <option value="class">Classe</option> 
                                <option value="bar">Bar</option>
                            </select>
                            <button type="button" class="btn btn-primary mr-1" onclick="createUser()">Invia</button>
                        </p>
                    </div>
                </div>  
            </div>

            
        <script type="application/javascript">
            function showForm() {
                let displ = $("#new").is( ":hidden" );
                    if (displ){
                        $("#new").slideDown("slow");
                    }else{
                        $("#new").slideUp();
                    }   
            }

            function createUser(){
                var name = $('#name').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var role = $('#role').val();
                $.ajax({  
                    type: "POST",                    
                    url: "/api/users",  
                    data: { 
                        api_token: '{{ Auth::user()->api_token }}',
                        name: name,
                        email: email,
                        password: password,
                        role: role,
                        _token: '{{csrf_token()}}',
                    },
                    dataType: "json",
                    success: function(risposta) {  
                        alert(risposta.message);
                        location.reload(true);
                    },
                    error: function(xhr, status, error) {
                    alert(xhr.responseText);
                    }
                }); 
            }       

            function deleteUser(id){
                $.ajax({  
                    type: "POST",                    
                    url: "/api/users/" + id,  
                    data: { 
                            api_token: '{{ Auth::user()->api_token }}',
                            _token: '{{csrf_token()}}',
                            _method: 'DELETE'
                    },
                    dataType: "json",
                    success: function(risposta) {  
                        alert(risposta.message);
                        location.reload(true);
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
