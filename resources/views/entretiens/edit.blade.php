<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-base font-bold text-dark-text">Modifier l'entretien</h2>
            <p class="text-xs text-dark-text-secondary mt-0.5">{{ $candidature->company_name }} — {{ $candidature->role }}</p>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">

            {{-- Back link --}}
            <a href="{{ route('candidatures.show', $candidature) }}" class="inline-flex items-center gap-1.5 text-sm text-dark-text-secondary hover:text-dark-text font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                Retour à la candidature
            </a>

            {{-- Context banner --}}
            @php
                $avatarGradients = [
                    'from-indigo-500 to-purple-600', 'from-emerald-500 to-teal-600',
                    'from-rose-500 to-pink-600', 'from-amber-500 to-orange-600',
                    'from-sky-500 to-cyan-600', 'from-violet-500 to-fuchsia-600',
                    'from-lime-500 to-green-600', 'from-blue-500 to-indigo-600',
                ];
                $avatarGradient = $avatarGradients[$candidature->id % count($avatarGradients)];
                $initial = strtoupper(substr($candidature->company_name, 0, 1));

                $typeColor = match ($entretien->type) {
                    'phone'     => ['bg' => 'bg-blue-500/10',    'text' => 'text-blue-500'],
                    'video'     => ['bg' => 'bg-indigo-500/10',  'text' => 'text-indigo-500'],
                    'technical' => ['bg' => 'bg-violet-500/10',  'text' => 'text-violet-500'],
                    'hr'        => ['bg' => 'bg-amber-500/10',   'text' => 'text-amber-500'],
                    'in_person' => ['bg' => 'bg-emerald-500/10', 'text' => 'text-emerald-500'],
                    default     => ['bg' => 'bg-overlay-subtle', 'text' => 'text-dark-text-secondary'],
                };
            @endphp

            <div class="glass-card overflow-hidden">
                <div class="h-1 w-full bg-gradient-to-r {{ $avatarGradient }}"></div>
                <div class="px-5 sm:px-7 py-4 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br {{ $avatarGradient }} flex items-center justify-center text-white font-bold text-sm shrink-0">
                        {{ $initial }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-dark-text truncate">{{ $candidature->company_name }}</p>
                        <p class="text-xs text-dark-text-secondary truncate">{{ $candidature->role }}</p>
                    </div>
                    <div class="shrink-0 flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium border border-dark-border {{ $typeColor['bg'] }} {{ $typeColor['text'] }}">
                            {{ $entretien->type_label }}
                        </span>
                        <span class="text-xs text-dark-text-secondary hidden sm:inline">
                            {{ $entretien->scheduled_at->format('d/m/Y à H:i') }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Form card --}}
            <div class="glass-card overflow-hidden">
                <div class="px-5 sm:px-7 pt-6 pb-5 border-b border-dark-border">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-dark-primary/10 flex items-center justify-center">
                            <svg class="w-4 h-4 text-dark-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-dark-text">Modifier l'entretien</h3>
                            <p class="text-xs text-dark-text-secondary mt-0.5">Mettez à jour les détails de cet entretien</p>
                        </div>
                    </div>
                </div>

                <div class="p-5 sm:p-7">
                    <form method="POST" action="{{ route('candidatures.entretiens.update', [$candidature, $entretien]) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Type + Date --}}
                        <div>
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-8 h-8 rounded-lg bg-blue-500/10 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                    </svg>
                                </div>
                                <h4 class="text-sm font-semibold text-dark-text">Planification</h4>
                                <div class="flex-1 h-px bg-dark-border"></div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="type" :value="__('Type *')" />
                                    <x-select-input id="type" name="type" class="mt-1.5" required>
                                        <option value="phone" {{ old('type', $entretien->type) == 'phone' ? 'selected' : '' }}>Téléphonique</option>
                                        <option value="video" {{ old('type', $entretien->type) == 'video' ? 'selected' : '' }}>Vidéo</option>
                                        <option value="technical" {{ old('type', $entretien->type) == 'technical' ? 'selected' : '' }}>Technique</option>
                                        <option value="hr" {{ old('type', $entretien->type) == 'hr' ? 'selected' : '' }}>RH</option>
                                        <option value="in_person" {{ old('type', $entretien->type) == 'in_person' ? 'selected' : '' }}>Présentiel</option>
                                    </x-select-input>
                                    <x-input-error :messages="$errors->get('type')" class="mt-1.5" />
                                </div>

                                <div>
                                    <x-input-label for="scheduled_at" :value="__('Date et heure *')" />
                                    <div class="relative mt-1.5">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                            <svg class="w-5 h-5 text-dark-text-secondary/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <x-text-input id="scheduled_at" class="block w-full pl-10 pr-3" type="datetime-local" name="scheduled_at" :value="old('scheduled_at', $entretien->scheduled_at->format('Y-m-d\TH:i'))" required />
                                    </div>
                                    <x-input-error :messages="$errors->get('scheduled_at')" class="mt-1.5" />
                                </div>
                            </div>
                        </div>

                        {{-- Notes --}}
                        <div class="pt-2">
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-8 h-8 rounded-lg bg-violet-500/10 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21h-7.5A2.25 2.25 0 016 18.75V14"/>
                                    </svg>
                                </div>
                                <h4 class="text-sm font-semibold text-dark-text">Notes préparatoires</h4>
                                <div class="flex-1 h-px bg-dark-border"></div>
                            </div>

                            <x-input-label for="notes" :value="__('Notes (optionnelles)')" />
                            <textarea id="notes" name="notes" class="block mt-1.5 w-full rounded-glass-input bg-dark-surface border border-dark-border px-4 py-2.5 text-sm text-dark-text placeholder-dark-text-secondary/50 focus:outline-none focus:border-dark-primary-hover focus:ring-2 focus:ring-dark-primary-hover/20 transition-all duration-200" rows="3" placeholder="Sujets à aborder, questions préparées, informations importantes...">{{ old('notes', $entretien->notes) }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-1.5" />
                        </div>

                        {{-- Result --}}
                        <div class="pt-2">
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h4 class="text-sm font-semibold text-dark-text">Résultat</h4>
                                <div class="flex-1 h-px bg-dark-border"></div>
                            </div>

                            <x-input-label for="result" :value="__('Résultat de l\'entretien (optionnel)')" />
                            <x-select-input id="result" name="result" class="mt-1.5">
                                <option value="">Non défini</option>
                                <option value="pending" {{ old('result', $entretien->result) == 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="positive" {{ old('result', $entretien->result) == 'positive' ? 'selected' : '' }}>Positif</option>
                                <option value="negative" {{ old('result', $entretien->result) == 'negative' ? 'selected' : '' }}>Négatif</option>
                                <option value="rescheduled" {{ old('result', $entretien->result) == 'rescheduled' ? 'selected' : '' }}>Reporté</option>
                            </x-select-input>
                            <x-input-error :messages="$errors->get('result')" class="mt-1.5" />
                        </div>

                        {{-- Footer actions --}}
                        <div class="flex items-center justify-end gap-3 pt-6 border-t border-dark-border">
                            <a href="{{ route('candidatures.show', $candidature) }}" class="flex items-center px-5 py-2.5 border border-dark-border rounded-glass-button text-sm font-medium text-dark-text-secondary bg-overlay-subtle hover:bg-overlay-hover hover:text-dark-text active:scale-[0.97] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-dark-primary transition-all duration-200">
                                Annuler
                            </a>
                            <x-primary-button>
                                <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182"/>
                                </svg>
                                Mettre à jour
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
