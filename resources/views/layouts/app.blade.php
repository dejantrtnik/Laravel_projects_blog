<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="shortcut icon" type="image/gif/png" href="/storage/app/public/static_images/logo_server_black.png">

    <link rel="stylesheet" href="{{ asset('resources/fontawesome/css/all.css') }}">

     <!-- JS -->
     <script type="text/javascript" src="{{ asset('resources/js/app.js') }}"></script>
     <!-- CSS -->
     <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
     <title>{{ config('app.name', 'Laravel') }}</title>
     <style type="text/css">

     .footer {
       position: fixed;
       right: 0;
       bottom: 0;
       left: 0;
       padding: 5px;
       opacity: 0.8;
       background-color: #efefef;
       text-align: center;
     }
     </style>
</head>
<body>
    @include('inc.navbar')
    <div class="container py-4">
        <div id="app">
            <main class="">
                @include('inc.messages')
                @yield('body')
            </main>
        </div>
    </div>
    @include('inc.footer')
    <script type="text/javascript">
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>

</body>
</html>
