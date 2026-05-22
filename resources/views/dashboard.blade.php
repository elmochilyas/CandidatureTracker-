<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-sm font-bold text-dark-text leading-tight">Tableau de bord</h2>
            <p class="text-xs text-dark-text-secondary mt-0.5">Vue d'ensemble</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-5">

            @php
                $months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
                $today = now()->day . ' ' . $months[now()->month - 1] . ' ' . now()->year;

                $avatarGradients = [
                    'from-indigo-500 to-purple-600',
                    'from-emerald-500 to-teal-600',
                    'from-rose-500 to-pink-600',
                    'from-amber-500 to-orange-600',
                    'from-sky-500 to-cyan-600',
                    'from-violet-500 to-fuchsia-600',
                    'from-lime-500 to-green-600',
                    'from-blue-500 to-indigo-600',
                ];
            @endphp

            {{-- Hero welcome card --}}
            <div class="glass-card overflow-hidden">
                <div class="relative p-6 sm:p-8">
                    <div class="absolute top-0 right-0 w-72 h-72 bg-gradient-to-bl from-dark-primary/8 to-transparent rounded-full blur-3xl -translate-y-1/2 translate-x-1/4 pointer-events-none"></div>
                    <div class="absolute -bottom-8 left-1/3 w-48 h-48 bg-gradient-to-tr from-dark-accent/5 to-transparent rounded-full blur-3xl pointer-events-none"></div>

                    <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">
                        <div class="flex items-center gap-4 sm:gap-5">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-gradient-primary flex items-center justify-center shadow-glow shrink-0 text-white text-lg font-bold select-none">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-xs text-dark-text-secondary mb-0.5">{{ $today }}</p>
                                <h1 class="text-lg sm:text-xl font-bold text-dark-text">Bonjour, {{ Auth::user()->name }} !</h1>
                                <p class="text-sm text-dark-text-secondary mt-0.5">
                                    @if ($stats['total'] > 0)
                                        Vous suivez <span class="font-semibold text-dark-text">{{ $stats['total'] }}</span> candidature{{ $stats['total'] > 1 ? 's' : '' }} active{{ $stats['total'] > 1 ? 's' : '' }}.
                                    @else
                                        Bienvenue sur CandidatureTracker. Commencez dès maintenant !
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 sm:shrink-0">
                            <a href="{{ route('candidatures.index') }}" class="flex items-center gap-1.5 px-3.5 py-2 border border-dark-border rounded-glass-button text-sm font-medium text-dark-text-secondary bg-overlay-subtle hover:bg-overlay-hover hover:text-dark-text active:scale-[0.97] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-dark-primary transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
                                </svg>
                                <span class="hidden sm:inline">Mes candidatures</span>
                                <span class="sm:hidden">Candidatures</span>
                            </a>
                            <a href="{{ route('candidatures.create') }}" class="flex items-center gap-1.5 px-4 py-2 bg-gradient-primary text-white text-sm font-semibold rounded-glass-button shadow-glow hover:shadow-glow-lg hover:-translate-y-0.5 active:scale-[0.97] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-dark-primary-hover focus-visible:ring-offset-2 focus-visible:ring-offset-dark-bg transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                                <span class="hidden sm:inline">Nouvelle candidature</span>
                                <span class="sm:hidden">Nouvelle</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if ($stats['total'] > 0)

                {{-- Stats row --}}
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
                    <div class="glass-card p-4 sm:p-5 hover-lift">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <p class="text-xs font-medium text-dark-text-secondary uppercase tracking-wider">Total</p>
                                <p class="mt-1.5 text-3xl font-bold text-dark-text">{{ $stats['total'] }}</p>
                                <p class="text-xs text-dark-text-secondary mt-1">candidature{{ $stats['total'] > 1 ? 's' : '' }}</p>
                            </div>
                            <div class="w-9 h-9 rounded-xl bg-overlay-subtle flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4.5 h-4.5 text-dark-text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card p-4 sm:p-5 stat-technical stat-card hover-lift">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <p class="text-xs font-medium text-dark-text-secondary uppercase tracking-wider">En cours</p>
                                <p class="mt-1.5 text-3xl font-bold stat-number">{{ $stats['inProgress'] }}</p>
                                <p class="text-xs text-dark-text-secondary mt-1">en attente de réponse</p>
                            </div>
                            <div class="w-9 h-9 rounded-xl bg-amber-500/10 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4.5 h-4.5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card p-4 sm:p-5 stat-interview stat-card hover-lift">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <p class="text-xs font-medium text-dark-text-secondary uppercase tracking-wider">Entretiens</p>
                                <p class="mt-1.5 text-3xl font-bold stat-number">{{ $stats['interviews'] }}</p>
                                <p class="text-xs text-dark-text-secondary mt-1">planifié{{ $stats['interviews'] > 1 ? 's' : '' }}</p>
                            </div>
                            <div class="w-9 h-9 rounded-xl bg-violet-500/10 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4.5 h-4.5 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card p-4 sm:p-5 stat-accepted stat-card hover-lift">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <p class="text-xs font-medium text-dark-text-secondary uppercase tracking-wider">Acceptées</p>
                                <p class="mt-1.5 text-3xl font-bold stat-number">{{ $stats['accepted'] }}</p>
                                <p class="text-xs text-dark-text-secondary mt-1">offre{{ $stats['accepted'] > 1 ? 's' : '' }} reçue{{ $stats['accepted'] > 1 ? 's' : '' }}</p>
                            </div>
                            <div class="w-9 h-9 rounded-xl bg-emerald-500/10 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4.5 h-4.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pipeline + Recent --}}
                <div class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-5 gap-5">

                    {{-- Status pipeline --}}
                    <div class="md:col-span-3 lg:col-span-3 glass-card p-5 sm:p-6">
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="text-sm font-semibold text-dark-text">Répartition des statuts</h2>
                            <a href="{{ route('candidatures.index') }}" class="text-xs text-dark-primary hover:text-dark-primary-hover transition-colors">
                                Voir tout
                            </a>
                        </div>

                        @php
                            $pipeline = [
                                ['label' => 'À postuler',       'count' => $stats['toApply'],   'color' => '#6366f1', 'status' => 'to_apply'],
                                ['label' => 'Candidature envoyée', 'count' => $stats['applied'], 'color' => '#3b82f6', 'status' => 'applied'],
                                ['label' => 'En attente',       'count' => $stats['waiting'],   'color' => '#d97706', 'status' => 'waiting'],
                                ['label' => 'Entretien planifié','count' => $stats['interviews'],'color' => '#7c3aed', 'status' => 'interview_scheduled'],
                                ['label' => 'Acceptée',         'count' => $stats['accepted'],  'color' => '#16a34a', 'status' => 'accepted'],
                                ['label' => 'Refus',            'count' => $stats['rejected'],  'color' => '#dc2626', 'status' => 'rejected'],
                            ];
                        @endphp

                        <div class="space-y-4">
                            @foreach ($pipeline as $stage)
                                @php $pct = $stats['total'] > 0 ? round(($stage['count'] / $stats['total']) * 100) : 0; @endphp
                                <div>
                                    <div class="flex items-center justify-between mb-1.5">
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full shrink-0" style="background-color: {{ $stage['color'] }}"></span>
                                            <span class="text-xs font-medium text-dark-text">{{ $stage['label'] }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs font-semibold text-dark-text">{{ $stage['count'] }}</span>
                                            <span class="text-xs text-dark-text-secondary w-8 text-right">{{ $pct }}%</span>
                                        </div>
                                    </div>
                                    <div class="h-1.5 rounded-full bg-overlay-hover overflow-hidden">
                                        <div class="h-full rounded-full transition-all duration-700" style="width: {{ $pct }}%; background-color: {{ $stage['color'] }}; opacity: 0.75;"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($stats['accepted'] > 0 || $stats['rejected'] > 0)
                            @php
                                $responded = $stats['accepted'] + $stats['rejected'];
                                $successRate = $responded > 0 ? round(($stats['accepted'] / $responded) * 100) : 0;
                            @endphp
                            <div class="mt-6 pt-4 border-t border-dark-border flex items-center gap-3">
                                <div class="flex-1 p-3 rounded-xl bg-emerald-500/8 border border-emerald-500/15">
                                    <p class="text-xs text-dark-text-secondary">Taux de succès</p>
                                    <p class="text-lg font-bold text-emerald-600 dark:text-emerald-400 mt-0.5">{{ $successRate }}%</p>
                                </div>
                                <div class="flex-1 p-3 rounded-xl bg-overlay-subtle border border-dark-border">
                                    <p class="text-xs text-dark-text-secondary">Réponses reçues</p>
                                    <p class="text-lg font-bold text-dark-text mt-0.5">{{ $responded }} / {{ $stats['total'] }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Recent candidatures --}}
                    <div class="md:col-span-2 lg:col-span-2 glass-card overflow-hidden flex flex-col">
                        <div class="flex items-center justify-between px-5 pt-5 pb-3">
                            <h2 class="text-sm font-semibold text-dark-text">Activité récente</h2>
                            <a href="{{ route('candidatures.index') }}" class="text-xs text-dark-primary hover:text-dark-primary-hover transition-colors">
                                Voir tout
                            </a>
                        </div>

                        <div class="flex-1 divide-y divide-dark-border/50">
                            @forelse ($recentCandidatures as $candidature)
                                @php
                                    $avatarGradient = $avatarGradients[$candidature->id % count($avatarGradients)];
                                    $initial = strtoupper(substr($candidature->company_name, 0, 1));
                                    $statusStyle = match ($candidature->status) {
                                        'to_apply'             => 'status-to-apply',
                                        'applied'              => 'status-applied',
                                        'waiting'              => 'status-technical',
                                        'interview_scheduled'  => 'status-interview',
                                        'rejected'             => 'status-rejected',
                                        'accepted'             => 'status-accepted',
                                        default                => 'status-archived',
                                    };
                                @endphp
                                <a href="{{ route('candidatures.show', $candidature) }}"
                                   class="group flex items-center gap-3 px-5 py-3.5 hover:bg-overlay-subtle transition-colors duration-150">
                                    <div class="shrink-0 w-8 h-8 rounded-lg bg-gradient-to-br {{ $avatarGradient }} flex items-center justify-center text-white font-bold text-xs group-hover:scale-105 transition-transform duration-200">
                                        {{ $initial }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-semibold text-dark-text truncate group-hover:text-dark-primary transition-colors">{{ $candidature->company_name }}</p>
                                        <p class="text-xs text-dark-text-secondary truncate">{{ $candidature->role }}</p>
                                    </div>
                                    <span class="badge badge-status {{ $statusStyle }} shrink-0">
                                        <span class="dot"></span>
                                        {{ $candidature->status_label }}
                                    </span>
                                </a>
                            @empty
                                <div class="px-5 py-8 text-center">
                                    <p class="text-sm text-dark-text-secondary">Aucune activité récente.</p>
                                </div>
                            @endforelse
                        </div>

                        <div class="px-5 py-3.5 border-t border-dark-border">
                            <a href="{{ route('candidatures.create') }}" class="w-full flex items-center justify-center gap-1.5 py-2 bg-gradient-primary text-white text-xs font-semibold rounded-glass-button shadow-glow hover:shadow-glow-lg hover:-translate-y-0.5 active:scale-[0.97] transition-all duration-200">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                                Ajouter une candidature
                            </a>
                        </div>
                    </div>

                </div>

            @else
                {{-- Empty state: quick actions --}}
                <div class="glass-card overflow-hidden">
                    <div class="p-6 sm:p-8">
                        <div class="text-center mb-8">
                            <div class="w-16 h-16 rounded-2xl bg-dark-primary/10 border border-dark-primary/20 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-dark-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/>
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-dark-text mb-1">Commencez votre suivi</h2>
                            <p class="text-sm text-dark-text-secondary max-w-sm mx-auto">Ajoutez vos premières candidatures pour avoir une vue d'ensemble de votre recherche d'emploi.</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <a href="{{ route('candidatures.create') }}" class="group flex items-center gap-4 p-5 rounded-2xl bg-dark-primary/5 border border-dark-primary/15 hover:bg-dark-primary/10 hover:-translate-y-0.5 active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-dark-primary transition-all duration-200">
                                <div class="w-11 h-11 rounded-xl bg-gradient-primary flex items-center justify-center shadow-glow shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-dark-text group-hover:text-dark-primary transition-colors">Nouvelle candidature</p>
                                    <p class="text-xs text-dark-text-secondary mt-0.5">Ajouter une opportunité</p>
                                </div>
                            </a>

                            <a href="{{ route('candidatures.index') }}" class="group flex items-center gap-4 p-5 rounded-2xl bg-overlay-card border border-dark-border hover:bg-overlay-hover hover:-translate-y-0.5 active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-dark-primary transition-all duration-200">
                                <div class="w-11 h-11 rounded-xl bg-dark-primary/15 flex items-center justify-center group-hover:bg-dark-primary/25 transition-colors shrink-0">
                                    <svg class="w-5 h-5 text-dark-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-dark-text">Mes candidatures</p>
                                    <p class="text-xs text-dark-text-secondary mt-0.5">Gérer mes candidatures</p>
                                </div>
                            </a>

                            <a href="{{ route('candidatures.archived') }}" class="group flex items-center gap-4 p-5 rounded-2xl bg-overlay-card border border-dark-border hover:bg-overlay-hover hover:-translate-y-0.5 active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-dark-primary transition-all duration-200">
                                <div class="w-11 h-11 rounded-xl bg-dark-warning/15 flex items-center justify-center group-hover:bg-dark-warning/25 transition-colors shrink-0">
                                    <svg class="w-5 h-5 text-dark-warning" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-dark-text">Archives</p>
                                    <p class="text-xs text-dark-text-secondary mt-0.5">Voir les archivées</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
