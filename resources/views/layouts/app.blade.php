<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script type="application/javascript" src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<div class="container-fluid">
     @yield('content')
</div>
</body>
</html>