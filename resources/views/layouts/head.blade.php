<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', setting('site_name'))</title>
    <!-- Normalize -->
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}" />
    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
    @if (app()->getLocale() == 'en')
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    @else
    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.rtl.min.css') }}" />
    @endif
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
    <!-- Main File Css  -->

    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <link rel="shortcut icon" type="image/jpg" href="{{ display_file(setting('icon_img')) }}" />

    @if (app()->getLocale() == 'en')
    <!-- Main File Ltr Css  -->
    <link rel="stylesheet" href="{{ asset('css/main-ltr.css') }}" />
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    @livewireStyles
    @stack('css')
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@500;600;700;800&display=swap"
        rel="stylesheet" />
</head>
<body>
