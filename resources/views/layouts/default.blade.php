<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', 'Laravel Weibo')</title>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <script src="{{ mix('js/app.js') }}"></script>
</head>

<body>
  @include('layouts._header')

  <div class="container pt-5">
    <div class="col-md-12">
      @include('shared._message')
      @yield('content')
    </div>
  </div>

  @include('layouts._footer')
</body>

</html>
