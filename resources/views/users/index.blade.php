@extends('layout')

@section('title', 'List of tires')

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
            <form method="post" action="{{ route('users.update', [ 'user' => $user->id ]) }}">
              @csrf
              @method('PATCH')
              <input type="hidden" name="promote" value='1'>
              <input type="submit" value="Promote">
            </form>
          @endif
        </td>
      </tr>
    @empty
      <div class="alert alert-warning">
        <h2>No users were found!</h2>
      </div>
    @endforelse
  </tbody>
</table>
@endsection
