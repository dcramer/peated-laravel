<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="{{ config('app.theme_color', '#18181b') }}">
        <meta name="description" content="{{ config('app.description', 'Track your whisky journey') }}">

        <title>{{ isset($title) ? $title . ' | ' . config('app.name', 'Peated') : config('app.name', 'Peated') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=raleway:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="h-full">
        <x-banner />

        <div class="min-h-screen">
            {{ $sidebar ?? view('components.sidebar') }}

            <div class="flex flex-col lg:pl-64">
                @if (isset($header))
                    <x-header>
                        {{ $header }}
                    </x-header>
                @endif

                <div className="flex">
                    <main className="w-full max-w-7xl flex-auto lg:pl-64">
                    <!-- Page Content -->
                        <div class="mx-auto py-4 lg:p-8">
                            {{ $slot }}
                        </div>
                    </main>
                </div>

                <x-footer>
                    @stack('footer')
                </x-footer>
            </div>
        </div>

        @if (config('services.fathom.site_id'))
            <x-fathom
                :site-id="config('services.fathom.site_id')"
                :included-domains="['peated.com']"
            />
        @endif

        @stack('modals')
        @livewireScripts
    </body>
</html>
