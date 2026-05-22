<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-base font-bold text-dark-text">Archives</h2>
            <p class="text-xs text-dark-text-secondary mt-0.5">{{ $candidatures->count() }} candidature(s) archivée(s)</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <a href="{{ route('candidatures.index') }}" class="inline-flex items-center gap-1.5 text-sm text-dark-text-secondary hover:text-dark-text font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                Candidatures actives
            </a>

            @if (session('success'))
                <div class="flex items-center gap-2.5 p-4 rounded-glass-input bg-dark-success/10 border border-dark-success/20 text-sm text-dark-success shadow-sm animate-scale-in">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @php
                $avatarGradients = [
                    'from-indigo-500 to-purple-600', 'from-emerald-500 to-teal-600',
                    'from-rose-500 to-pink-600', 'from-amber-500 to-orange-600',
                    'from-sky-500 to-cyan-600', 'from-violet-500 to-fuchsia-600',
                    'from-lime-500 to-green-600', 'from-blue-500 to-indigo-600',
                ];
            @endphp

            {{-- Toolbar --}}
            @if ($candidatures->count() > 0)
                <div class="flex items-center justify-between px-1">
                    <span class="inline-flex items-center gap-2 text-sm text-dark-text-secondary">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                        </svg>
                        <span><strong class="text-dark-text">{{ $candidatures->count() }}</strong> candidature(s) archivée(s)</span>
                    </span>
                </div>
            @endif

            {{-- List container --}}
            <div class="glass rounded-glass-card overflow-hidden">
                @forelse ($candidatures as $candidature)
                    @php
                        $avatarGradient = $avatarGradients[$candidature->id % count($avatarGradients)];
                        $initial = strtoupper(substr($candidature->company_name, 0, 1));
                    @endphp

                    <a href="{{ route('candidatures.show', $candidature) }}" class="group flex items-center gap-3 sm:gap-4 px-4 sm:px-5 py-4 hover:bg-overlay-subtle transition-colors border-b border-dark-border/50 last:border-b-0">
                        {{-- Avatar --}}
                        <div class="shrink-0 w-10 h-10 rounded-xl bg-gradient-to-br {{ $avatarGradient }} flex items-center justify-center text-white font-bold text-sm shadow-sm group-hover:scale-105 transition-transform duration-200">
                            {{ $initial }}
                        </div>

                        {{-- Company + role + archived date --}}
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-semibold text-dark-text truncate group-hover:text-dark-primary transition-colors">{{ $candidature->company_name }}</p>
                            <p class="text-xs text-dark-text-secondary truncate mt-0.5">{{ $candidature->role }}</p>
                            <p class="flex items-center gap-1 mt-1 text-xs text-dark-text-secondary/60">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                                </svg>
                                Archivée le {{ $candidature->deleted_at->format('d/m/Y') }}
                            </p>
                        </div>

                        {{-- Restore button --}}
                        <div class="shrink-0" onclick="event.stopPropagation()">
                            <form method="POST" action="{{ route('candidatures.restore', $candidature) }}">
                                @csrf
                                <button type="submit" onclick="event.preventDefault(); if(confirm('Restaurer cette candidature ?')){ this.closest('form').submit(); }" class="flex items-center gap-1.5 px-3 sm:px-4 py-2 bg-gradient-primary text-white text-xs font-semibold rounded-glass-button shadow-glow hover:shadow-glow-lg hover:-translate-y-0.5 active:scale-[0.97] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-dark-primary-hover focus-visible:ring-offset-2 transition-all duration-200">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15m0-3l-3-3m0 0l-3 3m3-3V15"/>
                                    </svg>
                                    <span class="hidden sm:inline">Restaurer</span>
                                </button>
                            </form>
                        </div>
                    </a>
                @empty
                    <div class="flex flex-col items-center justify-center py-20 px-4">
                        <div class="w-20 h-20 rounded-2xl bg-overlay-subtle border border-dark-border flex items-center justify-center mb-5">
                            <svg class="w-10 h-10 text-dark-text-secondary/30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-dark-text mb-2">Aucune candidature archivée</h3>
                        <p class="text-sm text-dark-text-secondary text-center max-w-xs leading-relaxed">Les candidatures que vous archivez apparaîtront ici. Vous pourrez les restaurer à tout moment.</p>
                        <a href="{{ route('candidatures.index') }}" class="mt-6 inline-flex items-center gap-1.5 text-sm text-dark-primary hover:text-dark-primary-hover font-medium transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                            Voir les candidatures actives
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
