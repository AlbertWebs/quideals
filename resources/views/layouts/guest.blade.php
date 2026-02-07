<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4 sm:px-6">
            <div class="mb-6 sm:mb-8">
                <a href="/" class="block">
                    <x-application-logo class="w-16 h-16 sm:w-20 sm:h-20 fill-current text-white mx-auto" />
                </a>
            </div>

            <div class="w-full sm:max-w-md bg-white shadow-xl rounded-2xl overflow-hidden">
                <div class="px-6 sm:px-8 py-8 sm:py-10">
                    {{ $slot }}
                </div>
            </div>
            
            <!-- Footer -->
            <div class="mt-6 text-center">
                <p class="text-white text-sm opacity-90">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                </p>
            </div>
        </div>
    </body>
</html>
