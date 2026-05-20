<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mes candidatures') }}
            </h2>
            <div class="flex items-center gap-4">
                <a href="{{ route('candidatures.archived') }}" class="text-sm text-gray-600 hover:text-gray-900">
                    Archives
                </a>
                <a href="{{ route('candidatures.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    + Nouvelle candidature
                </a>
            </div>
        </div>
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
                    @forelse ($candidatures as $candidature)
                        <a href="{{ route('candidatures.show', $candidature) }}" class="block border-b border-gray-200 py-4 last:border-b-0 hover:bg-gray-50 transition">
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
                        </a>
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
