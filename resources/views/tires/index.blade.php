@extends('layout')

@section('title', 'List of tires')

@section('extra_assets')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/tablefilter/tablefilter.js') }}"></script>
@endsection

@section('content')
<h1>All tires</h1>

<table class="table table-bordered table-hover table-striped align-middle table-to-be-filtered" style="width: initial; caption-side: initial;">
  <thead>
    <tr>
      <th>Size</th>
      <th>Brand</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Quantity Used</th>
      @if(strcmp(Auth::user()->user_type, 'admin') === 0)
        <th>Full edit</th>
        <th>Delete</th>
      @endif
    </tr>
  </thead>
  <tbody class="table-group-divider">
    @forelse($tires as $tire)
      <tr class="{{ session('updated_tire', -1) == $tire->id ? 'table-success' : '' }}">
        <td>{{ $tire->size }}</td>
        <td>{{ $tire->brand }}</td>
        <td>{{ $tire->price }}</td>
        <td>
          <div class="d-flex justify-content-between" id="tire-quantity-{{ $tire->id }}-viewer">
            <p style="margin: 0; align-content: center;">{{ $tire->quantity }}</p>
            <button class="btn btn-warning" onclick="javascript:changeTireQuantity('{{ $tire->id }}')">
              <i class="bi bi-pencil"></i>
            </button>
          </div>

          <form method="POST" action="{{ route('tires.quantity', [ 'tire' => $tire->id ] ) }}" class="d-none justify-content-between" id="tire-quantity-{{ $tire->id }}-changer" style="width: 300px;">
            @csrf
            @method('PATCH')

            <div class="d-flex justify-content-center">
              <button type="button" class="btn btn-outline-danger" onclick="javascript:subtractTireQuantity('{{ $tire->id }}')">
                <i class="bi bi-dash"></i>
              </button>
              <input type="text" class="form-control" style="width: 80px;" name="quantity" value="{{ $tire->quantity }}" id="tire-quantity-{{ $tire->id }}-value" data-last-quantity="{{ $tire->quantity }}">
              <button type="button" class="btn btn-outline-success" onclick="javascript:addTireQuantity('{{ $tire->id }}')">
                <i class="bi bi-plus"></i>
              </button>
            </div>

            <div class="d-flex justify-content-center">
              <button type="button" class="btn btn-warning" onclick="javascript:changeTireQuantity('{{ $tire->id }}')">
                <i class="bi bi-x"></i>
              </button>
              <button type="submit" class="btn btn-info">
                <i class="bi bi-check-all"></i>
              </button>
            </div>

          </form>
        </td>
        <td>{{ $tire->quantity_used }}</td>
        @if(strcmp(Auth::user()->user_type, 'admin') === 0)
          <td><a href="{{ route('tires.edit', [ 'tire' => $tire->id ]) }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a></td>
          <td>
            <form method="POST" action="{{ route('tires.destroy', ['tire' => $tire->id ]) }}">
              @method('DELETE')
              @csrf

              <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
            </form>
          </td>
        @endif
      </tr>
    @empty
      <div class="alert alert-warning">
        <h2>No tires were found!</h2>
      </div>
    @endforelse
  </tbody>
</table>
<script>
  var tf = new TableFilter(document.querySelector(".table-to-be-filtered"), {
      "base_path": "../js/tablefilter/",
      "rows_counter": {
        "text": 'Tires: '
      },
      "btn_reset": {
        "text": "clear"
      },
      "col_types": [
        "string",
        "string",
        "formatted-number",
        "number",
        "number",
        "none",
        "none"
      ],
      "filters_row_index": 1,
      "col_0": "select",
      "col_1": "select",
      "col_2": "none",
      "col_3": "none",
      "col_4": "none",
      "col_5": "none",
      "col_6": "none",
      "extensions": [{ "name": "sort" }]
  });
  tf.init();
</script>
@endsection
