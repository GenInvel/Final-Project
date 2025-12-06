<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TheSPARK - Truth knows no limits')</title>

     <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/sparklogo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/sparklogo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/sparklogo.png') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    @stack('styles')
</head>
<body>
    @include('partials.navbar')
    @include('partials.mobile-menu')
    @include('partials.auth-modal')
    
    <main>
        @yield('content')
    </main>
    
    @include('partials.footer')
    
    @stack('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>