<ul class="nav">
  @guest
    <li><a class="{{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a></li>
  @endguest
  @auth
    <li><a class="{{ request()->routeIs('tires.index') ? 'active' : '' }}" href="{{ route('tires.index') }}">All tires</a></li>
    <li><a class="{{ request()->routeIs('tires.create') ? 'active' : '' }}" href="{{ route('tires.create') }}">Create new tire</a></li>
    @if(strcmp(Auth::user()->user_type, 'admin') === 0)
      <li><a class="{{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">All users</a></li>
      <li><a class="{{ request()->routeIs('users.create') ? 'active' : '' }}" href="{{ route('users.create') }}">Create new user</a></li>
    @endif
    <li><a href="{{ route('logout') }}">logout</a></li>
    <li><a href="">Logged in as <b>{{ Auth::user()->name }}</b></a></li>
  @endauth
</ul>
