<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>@yield('title', config('app.name', 'Home & Kitchen Appliances') . ' - Quality Products for Your Home')</title>
    <meta name="description" content="@yield('description', 'Shop premium home and kitchen appliances in Kenya. Discover quality cookware, kitchen gadgets, home essentials and more at competitive prices.')">
    <meta name="keywords" content="@yield('keywords', 'home appliances, kitchen appliances, cookware, kitchen gadgets, home essentials, kitchenware, Kenya')">
    <meta name="author" content="Home & Kitchen Appliances">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('og_title', config('app.name', 'Home & Kitchen Appliances'))">
    <meta property="og:description" content="@yield('og_description', 'Shop premium home and kitchen appliances in Kenya. Discover quality cookware, kitchen gadgets, home essentials and more.')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('og_url', request()->url())">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.svg'))">
    <meta property="og:image:width" content="@yield('og_image_width', '1200')">
    <meta property="og:image:height" content="@yield('og_image_height', '630')">
    <meta property="og:image:alt" content="@yield('og_image_alt', config('app.name', 'Home & Kitchen Appliances'))">
    <meta property="og:site_name" content="Home & Kitchen Appliances">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
    @hasSection('og_price_amount')
    <meta property="product:price:amount" content="@yield('og_price_amount')">
    <meta property="product:price:currency" content="@yield('og_price_currency', 'KES')">
    <meta property="product:availability" content="@yield('og_product_availability', 'in stock')">
    @endif

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', config('app.name', 'Home & Kitchen Appliances'))">
    <meta name="twitter:description" content="@yield('twitter_description', 'Shop premium home and kitchen appliances in Kenya. Discover quality cookware, kitchen gadgets, home essentials and more.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/logo.svg'))">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ request()->url() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">

    <!-- Web App Manifest -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#1e40af">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Home & Kitchen">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Home & Kitchen">

    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://fonts.bunny.net">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')

    <!-- Structured Data -->
    @yield('structured_data')
</head>
<body class="bg-gray-50 font-sans md:pb-0 pb-16" style="font-family: 'Figtree', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
    @include('components.header')

    <main class="pb-16 md:pb-0">
        @yield('content')
    </main>

    @include('components.footer')
    @include('components.floating-cart-button')
    @include('components.mobile-bottom-nav')
    
    @stack('scripts')
</body>
</html>
