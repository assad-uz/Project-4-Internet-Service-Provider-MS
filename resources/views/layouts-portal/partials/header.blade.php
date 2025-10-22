<!doctype html>
<html lang="bn">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'SwiftNet - Internet Service Provider')</title>
  <meta name="description" content="@yield('meta_description', 'Fast, reliable, and affordable Internet services')">

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/portal.css') }}">

  <link rel="icon"
    type="image/png"
    href="{{ asset('portal-src/assets/img/logo/my_logo.png') }}"
    sizes="32x32">

  @stack('styles')
</head>

<body class="bg-light">