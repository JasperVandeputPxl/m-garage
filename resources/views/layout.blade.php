<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>M's Garage | @yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/main.css') }} ">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }} ">
</head>
<body>
  @include('_nav')

  @includeWhen($errors->any(), '_errors')

  @includeWhen(session('success'), '_success')

  <div class="main">
    @yield('content')
  </div>
</body>
</html>
