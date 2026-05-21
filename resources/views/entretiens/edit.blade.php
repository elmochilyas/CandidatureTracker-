<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier l\'entretien') }} — {{ $candidature->company_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('candidatures.entretiens.update', [$candidature, $entretien]) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="type" :value="__('Type')" />
                            <select id="type" name="type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="phone" {{ old('type', $entretien->type) == 'phone' ? 'selected' : '' }}>Téléphonique</option>
                                <option value="video" {{ old('type', $entretien->type) == 'video' ? 'selected' : '' }}>Vidéo</option>
                                <option value="technical" {{ old('type', $entretien->type) == 'technical' ? 'selected' : '' }}>Technique</option>
                                <option value="hr" {{ old('type', $entretien->type) == 'hr' ? 'selected' : '' }}>RH</option>
                                <option value="in_person" {{ old('type', $entretien->type) == 'in_person' ? 'selected' : '' }}>Présentiel</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="scheduled_at" :value="__('Date et heure')" />
                            <x-text-input id="scheduled_at" class="block mt-1 w-full" type="datetime-local" name="scheduled_at" :value="old('scheduled_at', $entretien->scheduled_at->format('Y-m-d\TH:i'))" required />
                            <x-input-error :messages="$errors->get('scheduled_at')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="notes" :value="__('Notes préparatoires (optionnelles)')" />
                            <textarea id="notes" name="notes" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="3">{{ old('notes', $entretien->notes) }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="result" :value="__('Résultat (optionnel)')" />
                            <select id="result" name="result" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Non défini</option>
                                <option value="pending" {{ old('result', $entretien->result) == 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="positive" {{ old('result', $entretien->result) == 'positive' ? 'selected' : '' }}>Positif</option>
                                <option value="negative" {{ old('result', $entretien->result) == 'negative' ? 'selected' : '' }}>Négatif</option>
                                <option value="rescheduled" {{ old('result', $entretien->result) == 'rescheduled' ? 'selected' : '' }}>Reporté</option>
                            </select>
                            <x-input-error :messages="$errors->get('result')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Mettre à jour') }}</x-primary-button>
                            <a href="{{ route('candidatures.show', $candidature) }}" class="text-sm text-gray-600 hover:text-gray-900">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
