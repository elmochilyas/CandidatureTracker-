<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes candidatures') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @forelse ($candidatures as $candidature)
                        <div class="border-b border-gray-200 py-4 last:border-b-0">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $candidature->company_name }}</h3>
                                    <p class="text-gray-600">{{ $candidature->role }}</p>
                                </div>
                                <div class="text-right text-sm">
                                    <span class="inline-block px-2 py-1 rounded bg-blue-100 text-blue-800">
                                        {{ $candidature->status_label }}
                                    </span>
                                    <span class="inline-block px-2 py-1 rounded bg-gray-100 text-gray-800 ml-1">
                                        {{ $candidature->priority_label }}
                                    </span>
                                </div>
                            </div>
                            <div class="mt-2 text-sm text-gray-500">
                                <span>Postulée le {{ $candidature->application_date->format('d/m/Y') }}</span>
                                <span class="ml-4">{{ $candidature->entretiens->count() }} entretien(s)</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">
                            Vous n'avez encore aucune candidature.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
