<head>
  <style>
    th, td {text-align:center; width: 75px;}
  </style>
</head>

<body>
  <h1>Liste di oggi</h1>
  @php
      $tot = 0;   // Variabile del totale
      $is_customer = false;  // Flag per considerare solo gli account dei clienti
  @endphp

  @foreach($users as $user)   <!-- Ciclo gli utenti -->

    @foreach ($orders as $order)
      @php $order->user_id == $user->id ? $is_customer = true : '' @endphp
    @endforeach

    @if ($is_customer)
      <h2>{{$user->name}}</h2>
      <table>
        <thead>
          <tr>
            <th>Nome</th>
            <th>Quantità</th>
            <th>Prezzo</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)   <!-- Ciclo gli ordini -->
            @if ($order->user_id == $user->id)   <!-- Utilizzo solo quelli dell'utente in ciclo -->
              <tr>
                <td>
                  @foreach ($sandwiches as $sandwich)    <!-- Cerco il nome del panino -->
                    @if ($order->sandwich_id == $sandwich->id)
                        {{$sandwich->name}}
                    @endif
                  @endforeach
                </td>
                <td>{{ $order->times }}</td>
                <td>{{ $order->price }}</td>
              </tr>
                  {{$tot += $order->times * $order->price}}
            @endif
          @endforeach
          <tr>
            <td>TOTALE</td>
            <td></td>
            <td>@php echo number_format((float) $tot, 2, '.', '') @endphp</td>
          </tr>
        </tbody>
      </table>
    @endif

    @php
    $tot = 0;   // Azzero la variabile del totale
    $is_customer = false;   // Reimposto il flag
    @endphp
  @endforeach

</body>