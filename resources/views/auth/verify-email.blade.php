<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="mx-auto w-12 h-12 rounded-full bg-dark-primary/10 flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-dark-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-dark-text">Vérifiez votre email</h2>
        <p class="mt-2 text-sm text-dark-text-secondary leading-relaxed">
            Merci de vous être inscrit ! Avant de commencer, veuillez vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="flex items-center gap-2 p-4 rounded-glass-input bg-dark-success/10 border border-dark-success/20 text-sm text-dark-success mb-4">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>Un nouveau lien de vérification a été envoyé à votre adresse email.</span>
        </div>
    @endif

    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 mt-6">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
            @csrf
            <x-primary-button class="w-full sm:w-auto text-xs">
                Renvoyer l'email
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
            @csrf
            <x-secondary-button class="w-full sm:w-auto text-xs">
                Se déconnecter
            </x-secondary-button>
        </form>
    </div>
</x-guest-layout>
