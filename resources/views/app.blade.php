<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <meta property="og:image" itemprop="image" content="{{ asset('assets/images/image.jpg') }}">
    <meta property="og:image:alt" content="Akbar & Dwi Wedding Image">
    <meta property="og:description" :content="`Akbar & Dwi akan menikah pada Minggu, 08 Januari 2023.`" />

    <title>Akbar & Dwi Wedding</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/plyr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <!-- Scripts -->
    @vite('resources/js/app.js')
    @inertiaHead
</head>

<body>
    @inertia

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src=" {{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/plyr.js') }}"></script>
</body>

</html>
