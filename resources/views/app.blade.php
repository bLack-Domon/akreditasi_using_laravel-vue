<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name') }}</title>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
    
    <link rel="shortcut icon" href="{{ asset('dist/logo.png') }}" type="image/x-icon">

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', 'resources/assets/plugins/fontawesome-free/css/all.min.css', 'resources/assets/dist/css/adminlte.min.css', 'resources/assets/plugins/jquery/jquery.min.js', 'resources/assets/plugins/bootstrap/js/bootstrap.bundle.min.js', 'resources/assets/dist/js/adminlte.min.js', 'resources/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="hold-transition">
    @inertia
</body>
</html>

