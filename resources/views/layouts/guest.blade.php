<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeHandler()" x-init="initTheme()" :class="{ 'dark': isDark }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-dark-bg text-dark-text">
        <div class="min-h-screen bg-dark-bg relative flex items-center justify-center px-4 py-12">
            <div class="fixed inset-0 pointer-events-none overflow-hidden">
                <div class="absolute -top-40 -right-40 w-96 h-96 bg-gradient-to-br from-dark-primary/10 to-dark-accent/5 rounded-full blur-[120px]"></div>
                <div class="absolute -bottom-40 -left-40 w-[30rem] h-[30rem] bg-gradient-to-tr from-dark-accent/5 to-dark-primary/5 rounded-full blur-[120px]"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[40rem] h-[40rem] bg-dark-primary/5 rounded-full blur-[160px]"></div>
            </div>

            <div class="w-full max-w-md relative animate-slide-up">
                <div class="text-center mb-8">
                    <div class="flex items-center justify-center gap-3 mb-4">
                        <x-application-logo class="h-10 w-auto fill-current text-dark-primary" />
                        <span class="text-xl font-bold text-dark-text tracking-tight">CandidatureTracker</span>
                    </div>
                    <p class="text-sm text-dark-text-secondary">Suivez et gérez vos candidatures efficacement</p>
                </div>

                <div class="glass-card p-8">
                    {{ $slot }}
                </div>

                <div class="mt-8 flex items-center justify-center gap-4">
                    <button @click="toggleTheme()" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-medium text-dark-text-secondary hover:text-dark-text hover:bg-overlay-subtle focus-visible:ring-2 focus-visible:ring-dark-primary transition-all duration-200">
                        <template x-if="!isDark">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/>
                            </svg>
                        </template>
                        <template x-if="isDark">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>
                            </svg>
                        </template>
                        <span x-text="isDark ? 'Mode clair' : 'Mode sombre'"></span>
                    </button>
                </div>
            </div>
        </div>
    </body>
</html>
