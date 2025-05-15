<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EMisi') }}</title>
        <link rel="shortcut icon" href="{{ asset('logo_gga.png') }}" type="image/png">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-row gap-x-6 justify-around sm:justify-center items-center dark:bg-gray-900">
            <div>
                <img src="{{asset('images/logo_kemenlhk.png')}}" class="w-[50px] mb-2">
                <h2 class="font-semibold text-5xl dark:text-white">EMisi.</h2>
                <span class="text-lg dark:text-white">Silakan Masukkan Username dan Password Anda <br> untuk Masuk ke dalam Sistem.</span>
            </div>
            <div class="p-4 border  dark:border-white border-slate-400 rounded-lg w-max md:flex">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>