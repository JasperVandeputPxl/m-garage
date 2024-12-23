@extends('layout')

@section('title', 'List of tires')

@section('content')
<h1>All tires</h1>

<table class="table table-bordered table-hover table-striped">
  <thead>
    <tr>
      <th>Size</th>
      <th>Brand</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Quantity Used</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    @forelse($tires as $tire)
      <tr>
        <td>{{ $tire->size }}</td>
        <td>{{ $tire->brand }}</td>
        <td>{{ $tire->price }}</td>
        <td>{{ $tire->quantity }}</td>
        <td>{{ $tire->quantity_used }}</td>
      </tr>
    @empty
      <div class="alert alert-warning">
        <h2>No tires were found!</h2>
      </div>
    @endforelse
  </tbody>
</table>
@endsection
