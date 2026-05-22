<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeHandler()" x-init="initTheme()" :class="{ 'dark': isDark }" @toggle-theme.window="toggleTheme()">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-dark-bg">
        <div class="min-h-screen bg-dark-bg relative">
            <div class="fixed inset-0 pointer-events-none overflow-hidden">
                <div class="absolute -top-40 -right-40 w-96 h-96 bg-gradient-to-br from-dark-primary/10 to-dark-accent/5 rounded-full blur-[120px] animate-float"></div>
                <div class="absolute -bottom-40 -left-40 w-[30rem] h-[30rem] bg-gradient-to-tr from-dark-accent/5 to-dark-primary/5 rounded-full blur-[120px] animate-float-delayed"></div>
            </div>

            @include('layouts.sidebar')

            <div class="lg:pl-64 relative page-enter">
                <div class="flex items-center gap-3 px-4 sm:px-6 lg:px-8 pt-3 lg:pt-6">
                    <button @click="$dispatch('toggle-mobile-menu')" class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-xl text-dark-text-secondary hover:text-dark-text hover:bg-overlay-subtle focus-visible:ring-2 focus-visible:ring-dark-primary transition-all duration-200 -ml-1" aria-label="Menu">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                    </button>
                    @isset($header)
                        <div class="flex-1 lg:hidden min-w-0">
                            {{ $header }}
                        </div>
                    @endisset
                </div>

                <main class="relative">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
