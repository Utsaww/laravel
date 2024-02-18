<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
    <head>
        <title>PadhLoJi</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="msapplication-TileColor" content="#0075f5">
        <meta name="theme-color" content="#0075f5">
        <link rel="shortcut icon" href="{{ asset('img/users/logo.png') }}" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
        <link href="{{ asset('css/users/style.css') }}" rel="stylesheet"/>
        <link href="{{ asset('flatiocn/flaticon.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/users/screens.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/users/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/users/owl.theme.default.min.css') }}" rel="stylesheet">
        <script src="{{ asset('js/users/jquery.min.js') }}"></script>
        <script src="{{ asset('js/users/main.js') }}"></script>
        <script src="{{ asset('js/users/owl.carousel.min.js') }}"></script>
     </head>
    <body>
        @include('users.includes.header')
        @yield('content')
        @include('users.includes.footer')
    </body>
</html>
