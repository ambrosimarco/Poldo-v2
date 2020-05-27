@extends('layouts.app')

@section('content')

        <!-- Container with the list of sandwiches -->
        <div class="container menu" style="margin-top: 80px; margin-bottom: 80px; padding-bottom: 2%;">
        <hr>
        <h1>Impostazioni</h1>
        <br>
        @if(Auth::user()->canAdminEdit())
        <form method="POST" action="">
          <label>
            <input name="online" type="checkbox" {{ ($settings->online == '1') ? 'checked' : ''}}>
            <span>Online</span>
          </label>
          <br />
          <label>
            <input name="debug_mode" type="checkbox" {{ ($settings->debug_mode == '1') ? 'checked' : ''}}>
            <span>Modalità debug</span>
          </label>
          <br />
          <label>
            <input name="no_wipe" type="checkbox" {{ ($settings->no_wipe == '1') ? 'checked' : ''}}>
            <span>Vincolo no-wipe</span>
          </label>
          <br />
          <label>
          <input name="order_time_limit" class="input-group-text" type="text" value="{{substr($settings->order_time_limit, 0, -3)}}">
            <span>Orario chiusura liste</span>
          </label>
          <label>
            <input name="retire_time" class="input-group-text" type="text" value="{{substr($settings->retire_time, 0, -3)}}">
              <span>Orario ritiro liste</span>
          </label>
          <input name="offline_message" class="input-group-text" type="text" value="{{$settings->offline_message}}">
          <span>Motivo sistema offline</span>
          </label>
          <input name="session_timeout" class="input-group-text" type="text" value="{{$settings->session_timeout}}">
          <span>Tempo timeout sessione (secondi)</span>
          </label>
          <br />
          <label>
          <input name="password" class="input-group-text" type="password" value="">
          <span>Inserire password per conferma</span>
          </label>
          @method('PATCH')
          @csrf
          <br />
          <br />
          <button class="btn btn-primary" type="submit">Invia</button>
        </form>  
        @endif
        <br />

        <button type="button" onclick="wipeSystem()" class="btn btn-primary mr-1">System wipe</button>
      </div>
        
        <script type="application/javascript">  
              function wipeSystem(button){
                $.ajax({  
                    type: "POST",                    
                    url: "api/settings",  
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


    


    

@endsection
