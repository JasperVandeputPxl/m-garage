<ul class="nav">
  <li><a class="{{ request()->routeIs('tires.create') ? 'active' : '' }}" href="{{ route('tires.create') }}">Create Tire</a></li>
  <li><a class="{{ request()->routeIs('tires.index') || request()->routeIs('home') ? 'active' : '' }}" href="{{ route('tires.index') }}">All tires</a></li>
</ul>
