<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-dark-text">Profil</h2>
            <p class="text-sm text-dark-text-secondary">Gérez vos informations personnelles et votre mot de passe</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
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
