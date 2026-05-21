<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $candidature->company_name }} — {{ $candidature->role }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Entreprise</dt>
                            <dd class="mt-1">{{ $candidature->company_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Poste visé</dt>
                            <dd class="mt-1">{{ $candidature->role }}</dd>
                        </div>
                        @if ($candidature->offer_url)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">URL de l'offre</dt>
                                <dd class="mt-1"><a href="{{ $candidature->offer_url }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 underline">{{ $candidature->offer_url }}</a></dd>
                            </div>
                        @endif
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Statut</dt>
                            <dd class="mt-1"><span class="inline-block px-2 py-1 rounded bg-blue-100 text-blue-800">{{ $candidature->status_label }}</span></dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Priorité</dt>
                            <dd class="mt-1"><span class="inline-block px-2 py-1 rounded bg-gray-100 text-gray-800">{{ $candidature->priority_label }}</span></dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Date de candidature</dt>
                            <dd class="mt-1">{{ $candidature->application_date->format('d/m/Y') }}</dd>
                        </div>
                    </dl>

                    @if ($candidature->notes)
                        <div class="mt-6">
                            <dt class="text-sm font-medium text-gray-500">Notes</dt>
                            <dd class="mt-1 whitespace-pre-wrap">{{ $candidature->notes }}</dd>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Entretiens</h3>

                @forelse ($candidature->entretiens as $entretien)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="p-4 text-gray-900">
                            <div class="flex items-start justify-between">
                                <div>
                                    <span class="inline-block px-2 py-1 rounded bg-purple-100 text-purple-800 text-sm">{{ $entretien->type_label }}</span>
                                    <p class="mt-1 text-sm text-gray-600">{{ $entretien->scheduled_at->format('d/m/Y à H:i') }}</p>
                                </div>
                                @if ($entretien->result)
                                    <span class="inline-block px-2 py-1 rounded text-sm {{ $entretien->result === 'positive' ? 'bg-green-100 text-green-800' : ($entretien->result === 'negative' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ $entretien->result_label }}
                                    </span>
                                @endif
                            </div>
                            @if ($entretien->notes)
                                <p class="mt-2 text-sm text-gray-500">{{ $entretien->notes }}</p>
                            @endif
                            @unless ($candidature->trashed())
                                <div class="mt-2 flex items-center gap-3">
                                    <a href="{{ route('candidatures.entretiens.edit', [$candidature, $entretien]) }}" class="text-sm text-indigo-600 hover:text-indigo-900 underline">Modifier</a>
                                    <form method="POST" action="{{ route('candidatures.entretiens.destroy', [$candidature, $entretien]) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Supprimer cet entretien ?')" class="text-sm text-red-600 hover:text-red-900 underline">Supprimer</button>
                                    </form>
                                </div>
                            @endunless
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Aucun entretien planifié pour le moment.</p>
                @endforelse

                @unless ($candidature->trashed())
                    <div class="mt-6 border-t pt-6">
                        <h4 class="font-medium text-gray-900 mb-4">Ajouter un entretien</h4>
                        <form method="POST" action="{{ route('candidatures.entretiens.store', $candidature) }}" class="space-y-4">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="type" :value="__('Type')" />
                                    <select id="type" name="type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                        <option value="phone" {{ old('type') == 'phone' ? 'selected' : '' }}>Téléphonique</option>
                                        <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Vidéo</option>
                                        <option value="technical" {{ old('type') == 'technical' ? 'selected' : '' }}>Technique</option>
                                        <option value="hr" {{ old('type') == 'hr' ? 'selected' : '' }}>RH</option>
                                        <option value="in_person" {{ old('type') == 'in_person' ? 'selected' : '' }}>Présentiel</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="scheduled_at" :value="__('Date et heure')" />
                                    <x-text-input id="scheduled_at" class="block mt-1 w-full" type="datetime-local" name="scheduled_at" :value="old('scheduled_at')" required />
                                    <x-input-error :messages="$errors->get('scheduled_at')" class="mt-2" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="notes" :value="__('Notes préparatoires (optionnelles)')" />
                                <textarea id="notes" name="notes" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="2">{{ old('notes') }}</textarea>
                                <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="result" :value="__('Résultat (optionnel)')" />
                                <select id="result" name="result" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Non défini</option>
                                    <option value="pending" {{ old('result') == 'pending' ? 'selected' : '' }}>En attente</option>
                                    <option value="positive" {{ old('result') == 'positive' ? 'selected' : '' }}>Positif</option>
                                    <option value="negative" {{ old('result') == 'negative' ? 'selected' : '' }}>Négatif</option>
                                    <option value="rescheduled" {{ old('result') == 'rescheduled' ? 'selected' : '' }}>Reporté</option>
                                </select>
                                <x-input-error :messages="$errors->get('result')" class="mt-2" />
                            </div>

                            <div>
                                <x-primary-button>Ajouter l'entretien</x-primary-button>
                            </div>
                        </form>
                    </div>
                @endunless
            </div>

            <div class="mt-6 flex items-center gap-4">
                @unless ($candidature->trashed())
                    <a href="{{ route('candidatures.edit', $candidature) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Modifier
                    </a>
                    <form method="POST" action="{{ route('candidatures.archive', $candidature) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <x-danger-button onclick="return confirm('Archiver cette candidature ?')">
                            Archiver
                        </x-danger-button>
                    </form>
                @else
                    <form method="POST" action="{{ route('candidatures.restore', $candidature) }}" class="inline">
                        @csrf
                        <x-primary-button onclick="return confirm('Restaurer cette candidature ?')">
                            Restaurer
                        </x-primary-button>
                    </form>
                @endunless
                <a href="{{ route('candidatures.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900">&larr; Retour à la liste</a>
            </div>
        </div>
    </div>
</x-app-layout>
