<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Page Title' }}</title>

  

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <wireui:scripts />
        <x-head.tinymce-config/>

    </head>
    <body class="font-sans antialiased">

        <x-notifications position="bottom-right" />

        <div class="flex px-5 py-3 bg-red-dkt">
            <div>
                <img src="{{ asset('assets/img/logo-dkt.png') }}" alt="Logo DKT International" class="w-20 " />

            </div>
            <div>
               

            </div>
            <div>

            </div>
        </div>
    

        <div class="min-h-screen bg-gray-100 pb-3">
            {{ $slot }}
        </div>

        @stack('js')
    </body>
</html>
