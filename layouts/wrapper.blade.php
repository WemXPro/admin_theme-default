<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="WemX Billing System">
    <meta name="keywords" content="WemX Panel, Billing Panel, @isset($keywords){{ $keywords }}@endisset">
    <meta name="author" content="WemX">

    <title>
        {!! __('admin.admin') !!} |
        @isset($title)
            {{ $title }}
        @endisset
        - {{ config('app.name') }}
    </title>

    <link rel="icon" type="image/png" href="@settings('favicon', '/assets/core/img/logo.png')">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/bootstrap/css/bootstrap.min.css')) }}"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet"/>

    <!-- CSS Libraries -->
    @yield('css_libraries')

    <style>
        .sidebar-dropdown::before {
            content: "→";
            display: inline-block;
            left: -14px;
            position: relative;
        }
        .active-nav {
            color: #4f46e5 !important;
            font-weight: 600 !important;
        }
    </style>

    <!-- Template CSS -->
    @if(Cache::get('admin_theme_mode_'.auth()->user()->id, 'light') == 'dark')
        <link rel="stylesheet" href="{{ asset(AdminTheme::assets('css/dark-style.css')) }}"/>
    @else
        <link rel="stylesheet" href="{{ asset(AdminTheme::assets('css/style.css')) }}"/>
    @endif

    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('css/custom.css')) }}"/>
    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('css/components.css')) }}"/>

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag("js", new Date());
        gtag("config", "UA-94034622-3");
    </script>
    <!-- /END GA -->
</head>

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg primary-bg"></div>

        {{-- We connect Navbar --}}
        @include(AdminTheme::path('layouts.partials.navbar'))

        {{-- Connect Sidebar --}}
        @include(AdminTheme::path('layouts.partials.sidebar'))

        <!-- The main part of the page -->
        <div class="main-content" style="min-height: 842px;">
            {{-- Alerts/message --}}
            @include(AdminTheme::path('layouts.partials.alerts'))

            {{-- The content of a specific page/section is displayed here --}}
            @yield('container')
        </div>

        {{-- Connect Footer --}}
        @include(AdminTheme::path('layouts.partials.footer'))
    </div>
</div>

<!-- General JS Scripts -->
<script src="{{ asset(AdminTheme::assets('modules/jquery.min.js')) }}"></script>
<script src="{{ asset(AdminTheme::assets('modules/popper.js')) }}"></script>
<script src="{{ asset(AdminTheme::assets('modules/tooltip.js')) }}"></script>
<script src="{{ asset(AdminTheme::assets('modules/bootstrap/js/bootstrap.min.js')) }}"></script>
<script src="{{ asset(AdminTheme::assets('modules/nicescroll/jquery.nicescroll.min.js')) }}"></script>
<script src="{{ asset(AdminTheme::assets('modules/moment.min.js')) }}"></script>
<script src="{{ asset(AdminTheme::assets('js/stisla.js')) }}"></script>

<!-- JS Libraries -->
@yield('js_libraries')

<!-- Template JS File -->
<script src="{{ asset(AdminTheme::assets('js/scripts.js')) }}"></script>
<script src="{{ asset(AdminTheme::assets('js/custom.js')) }}"></script>

<script>
    let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    function deleteItem(event) {
        if (!confirm('{!! __('admin.are_you_sure') !!}')) {
            event.preventDefault();
        }
    }

    function confirmAction(event, message) {
        if (!confirm(message)) {
            event.preventDefault();
        }
    }
</script>
</body>
</html>
