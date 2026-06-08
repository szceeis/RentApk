<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { background-color: #0D0D12; }
        </style>
    </head>
    <body class="font-sans text-gray-200 antialiased bg-[#0D0D12]">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
            
            <div class="relative z-10">
                <a href="/" class="text-4xl font-extrabold text-[#00FF66] tracking-wider drop-shadow-[0_0_8px_rgba(0,255,102,0.5)]">
                    RENTAL<span class="text-[#6600FF]">APP</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-8 px-8 py-10 bg-[#1A1B26] border border-[#2A2B3D] shadow-[0_0_30px_rgba(102,0,255,0.15)] overflow-hidden sm:rounded-2xl relative z-10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
