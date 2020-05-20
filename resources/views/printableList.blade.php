<h1>Customer List</h1>
<table>
  <thead>
    <tr>
      <th>Classe</th>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
    </tr>
  </thead>
  <tbody>
    @foreach($orders as $order)
      <tr>
          dd(order);
        <td>{{ $order->user_id }}</td>
        <td>{{ $order->sandwich_id }}</td>
        <td>{{ $order->price }}</td>
        <td>{{ $order->times }}</td>
      </tr>
    @endforeach
  </tbody>
</table>