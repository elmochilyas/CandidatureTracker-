<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier la candidature') }} — {{ $candidature->company_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('candidatures.update', $candidature) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="company_name" :value="__('Entreprise')" />
                            <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name', $candidature->company_name)" required autofocus />
                            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="role" :value="__('Poste visé')" />
                            <x-text-input id="role" class="block mt-1 w-full" type="text" name="role" :value="old('role', $candidature->role)" required />
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="offer_url" :value="__('URL de l\'offre (optionnelle)')" />
                            <x-text-input id="offer_url" class="block mt-1 w-full" type="url" name="offer_url" :value="old('offer_url', $candidature->offer_url)" />
                            <x-input-error :messages="$errors->get('offer_url')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Statut')" />
                            <select id="status" name="status" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="to_apply" {{ old('status', $candidature->status) == 'to_apply' ? 'selected' : '' }}>À postuler</option>
                                <option value="applied" {{ old('status', $candidature->status) == 'applied' ? 'selected' : '' }}>Candidature envoyée</option>
                                <option value="waiting" {{ old('status', $candidature->status) == 'waiting' ? 'selected' : '' }}>En attente</option>
                                <option value="interview_scheduled" {{ old('status', $candidature->status) == 'interview_scheduled' ? 'selected' : '' }}>Entretien programmé</option>
                                <option value="rejected" {{ old('status', $candidature->status) == 'rejected' ? 'selected' : '' }}>Refus</option>
                                <option value="accepted" {{ old('status', $candidature->status) == 'accepted' ? 'selected' : '' }}>Acceptée</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="priority" :value="__('Priorité')" />
                            <select id="priority" name="priority" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="low" {{ old('priority', $candidature->priority) == 'low' ? 'selected' : '' }}>Basse</option>
                                <option value="normal" {{ old('priority', $candidature->priority) == 'normal' ? 'selected' : '' }}>Normale</option>
                                <option value="high" {{ old('priority', $candidature->priority) == 'high' ? 'selected' : '' }}>Haute</option>
                            </select>
                            <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="notes" :value="__('Notes (optionnelles)')" />
                            <textarea id="notes" name="notes" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="4">{{ old('notes', $candidature->notes) }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="application_date" :value="__('Date de candidature')" />
                            <x-text-input id="application_date" class="block mt-1 w-full" type="date" name="application_date" :value="old('application_date', $candidature->application_date->format('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('application_date')" class="mt-2" />
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
