<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-sm font-bold text-dark-text leading-tight">Profil</h2>
            <p class="text-xs text-dark-text-secondary mt-0.5">Informations personnelles et sécurité</p>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">
            <div class="glass-card p-6 sm:p-8">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="glass-card p-6 sm:p-8">
                @include('profile.partials.update-password-form')
            </div>

            <div class="glass-card p-6 sm:p-8">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
