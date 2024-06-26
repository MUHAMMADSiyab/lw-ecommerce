<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PakEsports') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('components.layouts.navigation')
        <!-- Page Content -->
        <main class="w-[90%] mx-auto flex gap-6">
            @if (
                !request()->route()->named('product_details') &&
                    !request()->route()->named('cart') &&
                    !request()->route()->named('billing_details'))
                <div class="w-1/5">@include('components.layouts.sidebar')</div>
            @endif

            <div
                class="{{ !request()->route()->named('product_details') && !request()->route()->named('cart') && !request()->route()->named('billing_details') ? 'w-4/5' : 'w-full' }}">
                {{ $slot }}
            </div>

        </main>
    </div>

    @livewireScripts
    @stack('scripts')
</body>

</html>
