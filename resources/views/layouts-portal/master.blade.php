@include('layouts-portal.partials.header')
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            @include('layouts-portal.partials.navbar')

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container">
                    <!-- Insert Your content here -->
                    @yield('content')

                    Start creating your amazing application!

                </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            @include('layouts-portal.partials.footer')
            <!-- / Footer -->


    <!-- Child View files -->
    @extends('layouts-portal.base')

    @section('title', 'Admin Dashboard')
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/...') }}">
    @endpush

    @section('content')

    @endsection