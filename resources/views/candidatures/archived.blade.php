<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Archives') }}
            </h2>
            <a href="{{ route('candidatures.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900">&larr; Retour aux candidatures actives</a>
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
                        <div class="border-b border-gray-200 py-4 last:border-b-0">
                            <div class="flex items-start justify-between">
                                <a href="{{ route('candidatures.show', $candidature) }}" class="hover:bg-gray-50 transition flex-1">
                                    <h3 class="text-lg font-semibold">{{ $candidature->company_name }}</h3>
                                    <p class="text-gray-600">{{ $candidature->role }}</p>
                                    <div class="mt-2 text-sm text-gray-500">
                                        <span>Archivée le {{ $candidature->deleted_at->format('d/m/Y à H:i') }}</span>
                                    </div>
                                </a>
                                <div class="flex items-start gap-2 ml-4">
                                    <form method="POST" action="{{ route('candidatures.restore', $candidature) }}">
                                        @csrf
                                        <x-primary-button onclick="return confirm('Restaurer cette candidature ?')">
                                            Restaurer
                                        </x-primary-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">
                            Aucune candidature archivée.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
