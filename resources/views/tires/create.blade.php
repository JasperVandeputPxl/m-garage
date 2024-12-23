@extends('layout')

@section('title', 'Create new tire')

@section('content')
<h1>Create new tire</h1>

<form method="POST" action="{{ route('tires.store') }}">
  @csrf

  <label>Size</label>
  <input type="text" name="size" value="{{ old('size') }}" class="@error('size') error-border @enderror">
  @error('size') <div class="error">{{ $message }}</div> @enderror

  <label>Quantity</label>
  <input type="text" name="quantity" value="{{ old('quantity') }}" class="@error('quantity') error-border @enderror">
  @error('quantity') <div class="error">{{ $message }}</div> @enderror

  <label>Quantity used</label>
  <input type="text" name="quantity_used" value="{{ old('quantity_used') }}" class="@error('quantity_used') error-border @enderror">
  @error('quantity_used') <div class="error">{{ $message }}</div> @enderror

  <label>Brand</label>
  <input type="text" name="brand" value="{{ old('brand') }}" class="@error('brand') error-border @enderror">
  @error('brand') <div class="error">{{ $message }}</div> @enderror

  <label>Price</label>
  <input type="text" name="price" value="{{ old('price') }}" class="@error('price') error-border @enderror">
  @error('price') <div class="error">{{ $message }}</div> @enderror

  <button type="submit">Submit</button>
</form>
@endsection
