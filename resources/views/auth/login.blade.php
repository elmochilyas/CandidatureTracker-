<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-dark-text">Heureux de vous revoir</h2>
        <p class="mt-1 text-sm text-dark-text-secondary">Connectez-vous à votre espace</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <div class="relative mt-1.5">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <svg class="w-5 h-5 text-dark-text-secondary/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </div>
                <x-text-input id="email" class="block w-full pl-10 pr-3" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="vous@exemple.fr" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Mot de passe')" />
                @if (Route::has('password.request'))
                    <a class="text-xs text-dark-primary hover:text-dark-primary-hover font-medium transition-colors" href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>
            <div class="relative mt-1.5">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <svg class="w-5 h-5 text-dark-text-secondary/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                </div>
                <x-text-input id="password" class="block w-full pl-10 pr-3" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div class="flex items-center">
            <label for="remember_me" class="flex items-center gap-2 cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded border-dark-border bg-dark-surface text-dark-primary shadow-sm focus:ring-dark-primary-hover focus:ring-offset-0 transition-colors" name="remember">
                <span class="text-sm text-dark-text-secondary group-hover:text-dark-text transition-colors">Se souvenir de moi</span>
            </label>
        </div>

        <x-primary-button class="w-full justify-center">
            Se connecter
        </x-primary-button>
    </form>

    <p class="mt-8 text-center text-sm text-dark-text-secondary">
        Pas encore de compte ?
        <a href="{{ route('register') }}" class="text-dark-primary hover:text-dark-primary-hover font-medium transition-colors">S'inscrire</a>
    </p>
</x-guest-layout>
