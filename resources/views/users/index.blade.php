@extends('layout')

@section('title', 'List of tires')

@section('extra_assets')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection

@section('content')
<h1>All users</h1>

<table class="table table-bordered table-hover table-striped">
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>Email</th>
      <th>User type</th>
      <th>Promote?</th>
      @if(strcmp(Auth::user()->user_type, 'admin') === 0)
        <th>Full edit</th>
        <th>Delete</th>
      @endif
    </tr>
  </thead>
  <tbody class="table-group-divider">
    @forelse($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->user_type }}</td>
        <td>
          @if (strcmp($user->user_type, 'user') === 0)
            <form method="post" action="{{ route('users.promote', [ 'user' => $user->id ]) }}">
              @method('PATCH')
              @csrf

              <input type="hidden" name="promote" value='1'>
              <input type="submit" value="Promote">
            </form>
          @endif
        </td>
        @if(strcmp(Auth::user()->user_type, 'admin') === 0)
          <td><a href="{{ route('users.edit', [ 'user' => $user->id ]) }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a></td>
          <td><a href="{{ route('users.destroy', [ 'user' => $user->id ]) }}" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
        @endif
      </tr>
    @empty
      <div class="alert alert-warning">
        <h2>No users were found!</h2>
      </div>
    @endforelse
  </tbody>
</table>
@endsection
