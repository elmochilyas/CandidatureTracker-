<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-base font-bold text-dark-text truncate">{{ $candidature->company_name }}</h2>
            <p class="text-xs text-dark-text-secondary mt-0.5 truncate">{{ $candidature->role }}</p>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            {{-- Back link --}}
            <a href="{{ route('candidatures.index') }}" class="inline-flex items-center gap-1.5 text-sm text-dark-text-secondary hover:text-dark-text font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                Retour à la liste
            </a>

            {{-- Success flash --}}
            @if (session('success'))
                <div class="flex items-center gap-2.5 p-4 rounded-glass-input bg-dark-success/10 border border-dark-success/20 text-sm text-dark-success shadow-sm animate-scale-in">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- HERO CARD --}}
            @php
                $avatarGradients = [
                    'from-indigo-500 to-purple-600', 'from-emerald-500 to-teal-600',
                    'from-rose-500 to-pink-600', 'from-amber-500 to-orange-600',
                    'from-sky-500 to-cyan-600', 'from-violet-500 to-fuchsia-600',
                    'from-lime-500 to-green-600', 'from-blue-500 to-indigo-600',
                ];
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

                $priorityClasses = match ($candidature->priority) {
                    'high'   => 'bg-dark-danger/10 text-dark-danger border-dark-danger/20',
                    'normal' => 'bg-dark-warning/10 text-dark-warning border-dark-warning/20',
                    'low'    => 'bg-dark-success/10 text-dark-success border-dark-success/20',
                    default  => 'bg-overlay-subtle text-dark-text-secondary border-dark-border',
                };
            @endphp

            <div class="glass-card overflow-hidden">
                {{-- 3px gradient accent bar --}}
                <div class="h-1 w-full bg-gradient-to-r {{ $avatarGradient }}"></div>

                <div class="p-6 sm:p-8">
                    {{-- Hero header row --}}
                                <div class="flex flex-col sm:flex-row sm:items-start gap-5">
                        {{-- Avatar --}}
                        <div class="shrink-0 w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-br {{ $avatarGradient }} flex items-center justify-center text-white text-xl font-bold sm:text-2xl shadow-glow">
                            {{ $initial }}
                        </div>

                        {{-- Title + badges --}}
                        <div class="flex-1 min-w-0">
                            <h1 class="text-lg sm:text-xl font-bold text-dark-text truncate">{{ $candidature->company_name }}</h1>
                            <p class="text-sm sm:text-base text-dark-text-secondary mt-0.5 truncate">{{ $candidature->role }}</p>
                            <div class="flex flex-wrap items-center gap-2 mt-3">
                                <span class="badge badge-status {{ $statusStyle }}">
                                    <span class="dot"></span>
                                    {{ $candidature->status_label }}
                                </span>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium border {{ $priorityClasses }}">
                                    {{ $candidature->priority_label }}
                                </span>
                                <span class="inline-flex items-center gap-1.5 text-xs text-dark-text-secondary">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                    </svg>
                                    {{ $candidature->application_date->format('d/m/Y') }}
                                </span>
                                <span class="inline-flex items-center gap-1.5 text-xs text-dark-text-secondary">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>
                                    </svg>
                                    {{ $candidature->entretiens->count() }} entretien(s)
                                </span>
                            </div>
                        </div>

                        {{-- Action buttons --}}
                        <div class="shrink-0 flex items-center gap-2 sm:pt-1 w-full sm:w-auto">
                            @unless ($candidature->trashed())
                                <a href="{{ route('candidatures.edit', $candidature) }}" class="flex items-center gap-1.5 px-4 py-2.5 bg-gradient-primary text-white text-sm font-semibold rounded-glass-button shadow-glow hover:shadow-glow-lg hover:-translate-y-0.5 active:scale-[0.97] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-dark-primary-hover focus-visible:ring-offset-2 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                                    </svg>
                                    Modifier
                                </a>
                                <form method="POST" action="{{ route('candidatures.archive', $candidature) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Archiver cette candidature ?')" class="flex items-center gap-1.5 px-4 py-2.5 border border-dark-danger/30 bg-dark-danger/5 text-dark-danger text-sm font-semibold rounded-glass-button hover:bg-dark-danger/10 active:scale-[0.97] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-dark-danger/50 transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                                        </svg>
                                        Archiver
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('candidatures.restore', $candidature) }}" class="inline">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Restaurer cette candidature ?')" class="flex items-center gap-1.5 px-4 py-2.5 bg-gradient-primary text-white text-sm font-semibold rounded-glass-button shadow-glow hover:shadow-glow-lg hover:-translate-y-0.5 active:scale-[0.97] transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15m0-3l-3-3m0 0l-3 3m3-3V15"/>
                                        </svg>
                                        Restaurer
                                    </button>
                                </form>
                            @endunless
                        </div>
                    </div>

                    {{-- Meta info grid below divider --}}
                    @if ($candidature->offer_url || $candidature->attachments->isNotEmpty())
                        <div class="mt-6 pt-6 border-t border-dark-border flex flex-wrap gap-4">
                            @if ($candidature->offer_url)
                                <div class="flex items-center gap-3 px-4 py-2.5 rounded-glass-input bg-overlay-subtle border border-dark-border">
                                    <div class="w-7 h-7 rounded-lg bg-blue-500/10 flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                                        </svg>
                                    </div>
                                    <a href="{{ $candidature->offer_url }}" target="_blank" class="inline-flex items-center gap-1 text-sm text-dark-primary hover:text-dark-primary-hover font-medium transition-colors">
                                        Voir l'offre
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                    </a>
                                </div>
                            @endif

                            @foreach ($candidature->attachments as $attachment)
                                @php $icon = $attachment->icon; @endphp
                                <a href="{{ route('candidatures.attachments.download', [$candidature, $attachment]) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-glass-input bg-overlay-subtle border border-dark-border hover:bg-overlay-hover transition-colors group min-w-0">
                                    <div class="w-7 h-7 rounded-lg {{ $icon === 'pdf' ? 'bg-red-500/10' : ($icon === 'image' ? 'bg-emerald-500/10' : ($icon === 'word' ? 'bg-blue-500/10' : 'bg-violet-500/10')) }} flex items-center justify-center shrink-0">
                                        @if ($icon === 'pdf')
                                            <svg class="w-3.5 h-3.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                        @elseif ($icon === 'image')
                                            <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                                        @elseif ($icon === 'word')
                                            <svg class="w-3.5 h-3.5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                        @else
                                            <svg class="w-3.5 h-3.5 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776"/></svg>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <span class="text-sm font-medium text-dark-text-secondary group-hover:text-dark-text transition-colors block truncate">{{ $attachment->original_name }}</span>
                                        <span class="text-xs text-dark-text-secondary/60">{{ $attachment->size_for_humans }}</span>
                                    </div>
                                    <svg class="w-3.5 h-3.5 text-dark-text-secondary/40 group-hover:text-dark-primary shrink-0 ml-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                </a>
                            @endforeach
                        </div>
                    @endif

                    {{-- Notes --}}
                    @if ($candidature->notes)
                        <div class="mt-5 pt-5 border-t border-dark-border">
                            <p class="text-xs font-semibold text-dark-text-secondary uppercase tracking-wider mb-2">Notes</p>
                            <div class="p-4 rounded-glass-input bg-overlay-subtle border border-dark-border">
                                <p class="text-sm text-dark-text-secondary whitespace-pre-wrap leading-relaxed">{{ $candidature->notes }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Entretiens section --}}
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-dark-primary/10 flex items-center justify-center">
                            <svg class="w-4 h-4 text-dark-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-dark-text">Entretiens</h3>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-overlay-subtle border border-dark-border text-dark-text-secondary">
                        {{ $candidature->entretiens->count() }} entretien(s)
                    </span>
                </div>

                <div class="space-y-3">
                    @forelse ($candidature->entretiens as $entretien)
                        @php
                            $typeColor = match ($entretien->type) {
                                'phone'     => ['bg' => 'bg-blue-500/10',    'text' => 'text-blue-500',    'border' => 'border-l-blue-500'],
                                'video'     => ['bg' => 'bg-indigo-500/10',  'text' => 'text-indigo-500',  'border' => 'border-l-indigo-500'],
                                'technical' => ['bg' => 'bg-violet-500/10',  'text' => 'text-violet-500',  'border' => 'border-l-violet-500'],
                                'hr'        => ['bg' => 'bg-amber-500/10',   'text' => 'text-amber-500',   'border' => 'border-l-amber-500'],
                                'in_person' => ['bg' => 'bg-emerald-500/10', 'text' => 'text-emerald-500', 'border' => 'border-l-emerald-500'],
                                default     => ['bg' => 'bg-overlay-subtle', 'text' => 'text-dark-text-secondary', 'border' => 'border-l-dark-border'],
                            };

                            $resultBadge = match ($entretien->result) {
                                'positive'    => 'bg-dark-success/10 text-dark-success border-dark-success/20',
                                'negative'    => 'bg-dark-danger/10 text-dark-danger border-dark-danger/20',
                                'rescheduled' => 'bg-dark-warning/10 text-dark-warning border-dark-warning/20',
                                'pending'     => 'bg-overlay-subtle text-dark-text-secondary border-dark-border',
                                default       => 'bg-overlay-subtle text-dark-text-secondary/50 border-dark-border',
                            };

                            $typeIconPath = match ($entretien->type) {
                                'phone'     => 'M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0l6-6m-3 18c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 014.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 00-.38 1.21 12.035 12.035 0 007.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 011.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 01-2.25 2.25h-.75',
                                'video'     => 'M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z',
                                'technical' => 'M6.75 7.5l3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0021 18V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v12a2.25 2.25 0 002.25 2.25z',
                                'hr'        => 'M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z',
                                'in_person' => 'M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3H9m3-9h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6h.008v.008H15V6.75zm.375 3h.008v.008h-.008V9.75zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z',
                                default     => 'M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155',
                            };
                        @endphp

                        <div class="glass-card overflow-hidden hover-lift border-l-4 {{ $typeColor['border'] }}">
                            <div class="p-4 sm:p-5">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex items-start gap-3 min-w-0 flex-1">
                                        <div class="shrink-0 w-10 h-10 rounded-xl {{ $typeColor['bg'] }} flex items-center justify-center">
                                            <svg class="w-5 h-5 {{ $typeColor['text'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $typeIconPath }}"/>
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2 flex-wrap">
                                                <span class="text-sm font-semibold text-dark-text">{{ $entretien->type_label }}</span>
                                                @if ($entretien->result)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium border {{ $resultBadge }}">
                                                        {{ $entretien->result_label }}
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="flex items-center gap-1.5 text-sm text-dark-text-secondary mt-1">
                                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ $entretien->scheduled_at->format('d/m/Y à H:i') }}
                                            </p>
                                            @if ($entretien->notes)
                                                <p class="mt-2 text-sm text-dark-text-secondary bg-overlay-subtle rounded-lg px-3 py-2 border border-dark-border leading-relaxed">{{ $entretien->notes }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    @unless ($candidature->trashed())
                                        <div class="flex items-center gap-2 shrink-0">
                                            <a href="{{ route('candidatures.entretiens.edit', [$candidature, $entretien]) }}" class="inline-flex items-center gap-1 px-3 py-1.5 border border-dark-border rounded-lg text-xs font-medium text-dark-text-secondary bg-overlay-subtle hover:bg-overlay-hover hover:text-dark-text active:scale-[0.97] transition-all duration-200">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                                                </svg>
                                                Modifier
                                            </a>
                                            <form method="POST" action="{{ route('candidatures.entretiens.destroy', [$candidature, $entretien]) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Supprimer cet entretien ?')" class="inline-flex items-center gap-1 px-3 py-1.5 border border-dark-danger/30 rounded-lg text-xs font-medium text-dark-danger bg-overlay-subtle hover:bg-dark-danger/10 active:scale-[0.97] transition-all duration-200">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                    </svg>
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    @endunless
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="glass-card p-10 text-center">
                            <div class="w-14 h-14 rounded-2xl bg-overlay-subtle border border-dark-border flex items-center justify-center mx-auto mb-3">
                                <svg class="w-7 h-7 text-dark-text-secondary/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-dark-text">Aucun entretien planifié</p>
                            <p class="text-xs text-dark-text-secondary mt-1">Ajoutez un entretien ci-dessous pour commencer le suivi.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Add interview form --}}
                @unless ($candidature->trashed())
                    <div class="mt-5 glass-card overflow-hidden">
                        <div class="h-0.5 w-full bg-gradient-to-r from-dark-primary/40 to-dark-accent/40"></div>
                        <div class="p-6 sm:p-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-8 h-8 rounded-lg bg-dark-primary/10 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-dark-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                    </svg>
                                </div>
                                <h4 class="text-sm font-semibold text-dark-text">Ajouter un entretien</h4>
                                <div class="flex-1 h-px bg-dark-border"></div>
                            </div>

                            <form method="POST" action="{{ route('candidatures.entretiens.store', $candidature) }}" class="space-y-5">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <x-input-label for="type" :value="__('Type *')" />
                                        <x-select-input id="type" name="type" class="mt-1.5" required>
                                            <option value="phone">Téléphonique</option>
                                            <option value="video">Vidéo</option>
                                            <option value="technical">Technique</option>
                                            <option value="hr">RH</option>
                                            <option value="in_person">Présentiel</option>
                                        </x-select-input>
                                    </div>
                                    <div>
                                        <x-input-label for="scheduled_at" :value="__('Date et heure *')" />
                                        <x-text-input id="scheduled_at" class="block w-full mt-1.5" type="datetime-local" name="scheduled_at" required />
                                    </div>
                                </div>
                                <div>
                                    <x-input-label for="add_notes" :value="__('Notes (optionnelles)')" />
                                    <textarea id="add_notes" name="notes" class="block mt-1.5 w-full rounded-glass-input bg-dark-surface border border-dark-border px-4 py-2.5 text-sm text-dark-text placeholder-dark-text-secondary/50 focus:outline-none focus:border-dark-primary-hover focus:ring-2 focus:ring-dark-primary-hover/20 transition-all duration-200" rows="2" placeholder="Sujets à aborder, questions préparées..."></textarea>
                                </div>
                                <div>
                                    <x-input-label for="result" :value="__('Résultat (optionnel)')" />
                                    <x-select-input id="result" name="result" class="mt-1.5">
                                        <option value="">Non défini</option>
                                        <option value="pending">En attente</option>
                                        <option value="positive">Positif</option>
                                        <option value="negative">Négatif</option>
                                        <option value="rescheduled">Reporté</option>
                                    </x-select-input>
                                </div>
                                <div class="pt-2">
                                    <x-primary-button>
                                        <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                        </svg>
                                        Ajouter l'entretien
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endunless
            </div>

        </div>
    </div>
</x-app-layout>
