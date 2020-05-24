@extends('layouts.app')

@section('content')

<!-- Container with the list of users -->
<div class="container bg-white" style="margin-top: 80px; margin-bottom: 80px; padding-bottom: 2%;">

    <hr>

    <h1 class="mb-3">Utenti</h1>
    <div id="reloadForm">
        <div id="reloadUsers">
            @foreach($users as $user => $attributes)
            <div class="media p-1">
                <img src="./img/pan1.jpg" class="media-object" style="width:65px; height:65px">
                <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
                    <h4 class="media-heading {{($attributes->trashed == 'true') ? 'text-danger' : ''}}">{{$attributes->name}}</h4>
                    <div class="input-group">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary mr-1" onclick="viewUser({{$attributes->id}})">Vedi</a></button>
                            @if ($attributes->trashed == 'true')
                            <button type="button" class="btn btn-primary mr-1" onclick="enableUser({{$attributes->id}})">Attiva</button>
                            @else
                            <button type="button" class="btn btn-primary mr-1" onclick="disableUser({{$attributes->id}})">Disattiva</button>
                            @endif
                            <button type="button" class="btn btn-primary mr-1" onclick="deleteUser({{$attributes->id}})">Cancella</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class='none' id='view-{{$attributes->id}}'>
                <div class='card' style='width: 18rem;'>
                    <div class='card-body'>
                        <h5 class='card-title'>Modifica utente</h5>
                        <p class='card-text'>
                            <label for="name-{{$attributes->id}}">Nome</label>
                            <input type="text" value="{{$attributes->name}}" class="border border-dark" id="name-{{$attributes->id}}">
                            <label for="email-{{$attributes->id}}">Email</label>
                            <input type="text" value="{{$attributes->email}}" class="border border-dark" id="email-{{$attributes->id}}">
                            <label for="password-{{$attributes->id}}">Password (vuoto per non modificare)</label>
                            <input type="password" class="border border-dark" id="password-{{$attributes->id}}">
                            <label for="field-{{$attributes->id}}">Ruolo</label>
                            <select class="field" id="role-{{$attributes->id}}">
                                <option value="admin" {{ $attributes->role == 'admin' ? 'selected' : '' }}>Amministratore</option>
                                <option value="class" {{ $attributes->role == 'class' ? 'selected' : '' }}>Classe</option>
                                <option value="bar" {{ $attributes->role == 'bar' ? 'selected' : '' }}>Bar</option>
                            </select>
                            <button type="button" class="btn btn-primary mr-1" onclick="editUser({{$attributes->id}})">Invia</button>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-primary mr-1" onclick="showForm()">Nuovo</button>
        <div class='none' id='new'>
            <div class='card' style='width: 18rem;'>
                <div class='card-body'>
                    <h5 class='card-title'>Nuovo utente</h5>
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
    </div>


    <script type="application/javascript">
        function showForm() {
            let displ = $("#new").is(":hidden");
            if (displ) {
                $("#new").slideDown("slow");
            } else {
                $("#new").slideUp();
            }
        }

        function viewUser(id) {
            let displ = $("#view-" + id).is(":hidden");
            if (displ) {
                $("#view-" + id).slideDown("slow");
            } else {
                $("#view-" + id).slideUp();
            }
        }

        function createUser() {
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
                    $("#reloadForm").load(location.href + " #reloadForm");
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }

        function editUser(id) {
            var name = $('#name-' + id).val();
            var email = $('#email-' + id).val();
            var password = $('#password-' + id).val();
            var role = $('#role-' + id).val();
            $.ajax({
                type: "POST",
                url: "/api/users/" + id,
                data: {
                    api_token: '{{ Auth::user()->api_token }}',
                    name: name,
                    email: email,
                    password: password,
                    role: role,
                    _token: '{{csrf_token()}}',
                    _method: 'PATCH'
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

        function enableUser(id) {
            $.ajax({
                type: "POST",
                url: "/api/users/restore/" + id,
                data: {
                    api_token: '{{ Auth::user()->api_token }}',
                    _token: '{{csrf_token()}}',
                    _method: 'PATCH'
                },
                dataType: "json",
                success: function(risposta) {
                    alert(risposta.message);
                    $("#reloadUsers").load(location.href + " #reloadUsers");
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }

        function disableUser(id) {
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
                    $("#reloadUsers").load(location.href + " #reloadUsers");
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }

        function deleteUser(id) {
            $.ajax({
                type: "POST",
                url: "/api/users/hard/" + id,
                data: {
                    api_token: '{{ Auth::user()->api_token }}',
                    _token: '{{csrf_token()}}',
                    _method: 'DELETE'
                },
                dataType: "json",
                success: function(risposta) {
                    alert(risposta.message);
                    $("#reloadUsers").load(location.href + " #reloadUsers");
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