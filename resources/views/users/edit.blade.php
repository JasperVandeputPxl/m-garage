@extends('layout')

@section('title', 'Edit user' . $user->id)

@section('content')
<h1>Edit user</h1>

<form method="POST" action="{{ route('users.update', [$user]) }}">
  @method('PUT')
  @csrf

  <label>Name</label>
  <input class="@error('name') error-border @enderror" type="text" name="name" value="{{ old('name', $user->name) }}">
  @error('name') <div class="error">{{ $message }}</div> @enderror

  <label>Email</label>
  <input class="@error('email') error-border @enderror" type="text" name="email" value="{{ old('email', $user->email) }}">
  @error('email') <div class="error">{{ $message }}</div> @enderror

  <label>Password</label>
  <input class="@error('password') error-border @enderror" type="password" name="password">
  @error('password') <div class="error">{{ $message }}</div> @enderror

  <button type="submit">Update</button>
</form>
@endsection
