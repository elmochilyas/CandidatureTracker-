<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-sm font-bold text-dark-text leading-tight">Mes candidatures</h2>
            <p class="text-xs text-dark-text-secondary mt-0.5">{{ $candidatures->count() }} active(s)</p>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            @if (session('success'))
                <div class="flex items-center gap-2.5 p-4 rounded-glass-input bg-dark-success/10 border border-dark-success/20 text-sm text-dark-success shadow-sm animate-scale-in">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @php
                $_total = $candidatures->count();
                $_toApply = $candidatures->where('status', 'to_apply')->count();
                $_inProgress = $candidatures->whereIn('status', ['applied', 'waiting'])->count();
                $_interview = $candidatures->where('status', 'interview_scheduled')->count();
                $_finished = $candidatures->whereIn('status', ['rejected', 'accepted'])->count();
                $_highPriority = $candidatures->where('priority', 'high')->count();
            @endphp

            @if ($_total > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3">
                    <div class="glass-card p-3.5 stat-card hover-lift">
                        <div class="flex items-start justify-between mb-2">
                            <p class="text-xs font-medium text-dark-text-secondary uppercase tracking-wider leading-none">Total</p>
                            <div class="w-6 h-6 rounded-lg bg-overlay-subtle flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5 text-dark-text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-2xl font-bold text-dark-text">{{ $_total }}</p>
                    </div>

                    <div class="glass-card p-3.5 stat-applied stat-card hover-lift">
                        <div class="flex items-start justify-between mb-2">
                            <p class="text-xs font-medium text-dark-text-secondary uppercase tracking-wider leading-none">À postuler</p>
                            <div class="w-6 h-6 rounded-lg bg-blue-500/10 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-2xl font-bold stat-number">{{ $_toApply }}</p>
                    </div>

                    <div class="glass-card p-3.5 stat-technical stat-card hover-lift">
                        <div class="flex items-start justify-between mb-2">
                            <p class="text-xs font-medium text-dark-text-secondary uppercase tracking-wider leading-none">En cours</p>
                            <div class="w-6 h-6 rounded-lg bg-amber-500/10 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-2xl font-bold stat-number">{{ $_inProgress }}</p>
                    </div>

                    <div class="glass-card p-3.5 stat-interview stat-card hover-lift">
                        <div class="flex items-start justify-between mb-2">
                            <p class="text-xs font-medium text-dark-text-secondary uppercase tracking-wider leading-none">Entretiens</p>
                            <div class="w-6 h-6 rounded-lg bg-violet-500/10 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-2xl font-bold stat-number">{{ $_interview }}</p>
                    </div>

                    <div class="glass-card p-3.5 stat-accepted stat-card hover-lift">
                        <div class="flex items-start justify-between mb-2">
                            <p class="text-xs font-medium text-dark-text-secondary uppercase tracking-wider leading-none">Finalisées</p>
                            <div class="w-6 h-6 rounded-lg bg-emerald-500/10 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-2xl font-bold stat-number">{{ $_finished }}</p>
                    </div>

                    <div class="glass-card p-3.5 stat-rejected stat-card hover-lift">
                        <div class="flex items-start justify-between mb-2">
                            <p class="text-xs font-medium text-dark-text-secondary uppercase tracking-wider leading-none">Priorité haute</p>
                            <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-2xl font-bold stat-number">{{ $_highPriority }}</p>
                    </div>
                </div>
            @endif

            <div class="glass overflow-hidden rounded-glass-card">

                {{-- Toolbar --}}
                <div class="flex items-center justify-between gap-4 px-4 sm:px-5 py-4 border-b border-dark-border">
                    <p class="text-sm font-semibold text-dark-text">
                        @if (request('status') || request('priority') || request('search'))
                            {{ $candidatures->count() }} résultat(s) filtré(s)
                        @else
                            Toutes les candidatures
                        @endif
                    </p>
                    <a href="{{ route('candidatures.create') }}" class="flex items-center gap-1.5 px-3.5 py-2 bg-gradient-primary text-white text-sm font-semibold rounded-glass-button shadow-glow hover:shadow-glow-lg hover:-translate-y-0.5 active:scale-[0.97] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-dark-primary-hover focus-visible:ring-offset-2 focus-visible:ring-offset-dark-bg transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                        <span class="hidden sm:inline">Nouvelle candidature</span>
                        <span class="sm:hidden">Nouvelle</span>
                    </a>
                </div>

                {{-- Filter bar --}}
                <div class="px-4 sm:px-5 py-3.5 border-b border-dark-border bg-dark-surface/30">
                    <form method="GET" action="{{ route('candidatures.index') }}" class="flex flex-wrap gap-2.5 items-center">
                        <div class="flex-1 min-w-[200px] relative">
                            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-dark-text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                                </svg>
                            </div>
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Entreprise ou poste..."
                                class="w-full rounded-glass-input bg-dark-surface border border-dark-border pl-9 pr-4 py-2.5 text-sm text-dark-text placeholder-dark-text-secondary/50 focus:outline-none focus:border-dark-primary-hover focus:ring-2 focus:ring-dark-primary-hover/20 transition-all duration-200"
                            >
                        </div>

                        <div class="min-w-[170px] flex-1 sm:flex-none">
                            <x-select-input name="status">
                                <option value="">Tous les statuts</option>
                                <option value="to_apply" {{ request('status') == 'to_apply' ? 'selected' : '' }}>À postuler</option>
                                <option value="applied" {{ request('status') == 'applied' ? 'selected' : '' }}>Candidature envoyée</option>
                                <option value="waiting" {{ request('status') == 'waiting' ? 'selected' : '' }}>En attente</option>
                                <option value="interview_scheduled" {{ request('status') == 'interview_scheduled' ? 'selected' : '' }}>Entretien programmé</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Refus</option>
                                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Acceptée</option>
                            </x-select-input>
                        </div>

                        <div class="min-w-[150px] flex-1 sm:flex-none">
                            <x-select-input name="priority">
                                <option value="">Toutes priorités</option>
                                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Basse</option>
                                <option value="normal" {{ request('priority') == 'normal' ? 'selected' : '' }}>Normale</option>
                                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>Haute</option>
                            </x-select-input>
                        </div>

                        <div class="flex items-center gap-2 shrink-0 w-full sm:w-auto">
                            <button type="submit" class="flex-1 sm:flex-none flex items-center justify-center gap-1.5 px-3.5 py-2.5 bg-gradient-primary text-white text-sm font-semibold rounded-glass-button shadow-glow hover:shadow-glow-lg hover:-translate-y-0.5 active:scale-[0.97] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-dark-primary-hover focus-visible:ring-offset-2 focus-visible:ring-offset-dark-bg transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"/>
                                </svg>
                                Filtrer
                            </button>
                            @if (request('status') || request('priority') || request('search'))
                                <a href="{{ route('candidatures.index') }}" class="flex items-center justify-center gap-1 px-3 py-2.5 border border-dark-border rounded-glass-button text-xs font-medium text-dark-text-secondary bg-overlay-subtle hover:bg-overlay-hover hover:text-dark-text active:scale-[0.97] transition-all duration-200">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Effacer
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                {{-- Candidature list --}}
                <div class="divide-y divide-dark-border/50">
                    @php
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

                    @forelse ($candidatures as $candidature)
                        @php
                            $avatarGradient = $avatarGradients[$candidature->id % count($avatarGradients)];
                            $initial = strtoupper(substr($candidature->company_name, 0, 1));

                            $statusStyle = match ($candidature->status) {
                                'to_apply' => 'status-to-apply',
                                'applied' => 'status-applied',
                                'waiting' => 'status-technical',
                                'interview_scheduled' => 'status-interview',
                                'rejected' => 'status-rejected',
                                'accepted' => 'status-accepted',
                                default => 'status-archived',
                            };
                        @endphp

                        <a href="{{ route('candidatures.show', $candidature) }}"
                           class="group flex items-center gap-3 sm:gap-4 px-4 sm:px-5 py-3.5 hover:bg-overlay-subtle transition-colors duration-150 {{ $candidature->priority === 'high' ? 'border-l-2 border-l-dark-danger' : '' }}">

                            <div class="shrink-0 w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-gradient-to-br {{ $avatarGradient }} flex items-center justify-center text-white font-bold text-sm shadow-sm group-hover:scale-105 transition-transform duration-200">
                                {{ $initial }}
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap mb-0.5">
                                    <span class="text-sm font-semibold text-dark-text group-hover:text-dark-primary transition-colors truncate">
                                        {{ $candidature->company_name }}
                                    </span>
                                    @if ($candidature->priority === 'high')
                                        <span class="inline-flex items-center gap-1 text-xs font-medium text-dark-danger shrink-0">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                            </svg>
                                            Priorité haute
                                        </span>
                                    @endif
                                </div>
                                <p class="text-xs text-dark-text-secondary truncate">{{ $candidature->role }}</p>
                                <div class="sm:hidden mt-1">
                                    <span class="badge badge-status {{ $statusStyle }}">
                                        <span class="dot"></span>
                                        {{ $candidature->status_label }}
                                    </span>
                                </div>
                            </div>

                            <div class="hidden sm:block shrink-0">
                                <span class="badge badge-status {{ $statusStyle }}">
                                    <span class="dot"></span>
                                    {{ $candidature->status_label }}
                                </span>
                            </div>

                            <div class="hidden md:flex items-center gap-4 text-xs text-dark-text-secondary shrink-0">
                                <span class="flex items-center gap-1.5 whitespace-nowrap">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                    </svg>
                                    {{ $candidature->application_date->format('d/m/Y') }}
                                </span>

                                <span class="flex items-center gap-1.5 whitespace-nowrap {{ $candidature->entretiens->count() > 0 ? 'text-dark-primary' : '' }}">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>
                                    </svg>
                                    {{ $candidature->entretiens->count() }}
                                </span>

                                @if ($candidature->attachments->isNotEmpty())
                                    <span class="flex items-center text-dark-success relative" title="{{ $candidature->attachments->count() }} fichier(s) joint(s)">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"/>
                                        </svg>
                                        <span class="absolute -top-1.5 -right-1.5 w-3.5 h-3.5 rounded-full bg-dark-success text-[9px] font-bold text-white flex items-center justify-center">{{ $candidature->attachments->count() }}</span>
                                    </span>
                                @endif
                            </div>

                            <svg class="w-4 h-4 text-dark-border group-hover:text-dark-primary transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                            </svg>
                        </a>
                    @empty
                        <div class="flex flex-col items-center justify-center py-20 px-4">
                            <div class="w-20 h-20 rounded-2xl bg-dark-primary/10 border border-dark-primary/20 flex items-center justify-center mb-6">
                                <svg class="w-10 h-10 text-dark-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/>
                                </svg>
                            </div>
                            @if (request('status') || request('priority') || request('search'))
                                <h3 class="text-lg font-bold text-dark-text mb-1">Aucun résultat</h3>
                                <p class="text-sm text-dark-text-secondary mb-6 text-center max-w-xs">Aucune candidature ne correspond à vos filtres.</p>
                                <a href="{{ route('candidatures.index') }}" class="flex items-center gap-2 px-4 py-2 border border-dark-border rounded-glass-button text-sm font-medium text-dark-text-secondary bg-overlay-subtle hover:bg-overlay-hover hover:text-dark-text active:scale-[0.97] transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Effacer les filtres
                                </a>
                            @else
                                <h3 class="text-lg font-bold text-dark-text mb-1">Aucune candidature</h3>
                                <p class="text-sm text-dark-text-secondary mb-8 text-center max-w-xs">Vous n'avez pas encore créé de candidature. Lancez-vous dès maintenant !</p>
                                <a href="{{ route('candidatures.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-gradient-primary text-white text-sm font-semibold rounded-glass-button shadow-glow hover:shadow-glow-lg hover:-translate-y-0.5 active:scale-[0.97] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-dark-primary-hover focus-visible:ring-offset-2 focus-visible:ring-offset-dark-bg transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                    </svg>
                                    Créer une candidature
                                </a>
                            @endif
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
