<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>StatusPage Module - {{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}">
    <meta name="author" content="{{ $author ?? '' }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Vite CSS --}}
    {{-- {{ module_vite('build-statuspage', 'resources/assets/sass/app.scss', storage_path('vite.hot')) }} --}}
    @vite('resources/css/app.css')

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ Module::asset('StatusPage:css/app.css') }}">
  </head>

  <body>
    @yield('content')
    {{-- Vite JS --}}
    {{-- {{ module_vite('build-statuspage', 'resources/assets/js/app.js', storage_path('vite.hot')) }} --}}
  </body>

  <style>
    body, html {
      background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      height: 100%;
    }
  </style>
</html>