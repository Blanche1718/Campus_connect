<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestion des Équipements') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            {{-- Bouton nouvel équipement --}}
            <div class="flex justify-end mb-6">
                <a href="{{ route('equipements.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white 
                          text-sm font-semibold rounded-md shadow transition">
                    Nouvel équipement
                </a>
            </div>

            <div class="backdrop-blur-xl bg-white/60 dark:bg-gray-800/50 shadow-xl border border-gray-200/40 
                        dark:border-gray-700/30 sm:rounded-lg overflow-hidden">

                <div class="p-6">

                    @if ($equipements->count())

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">#</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Nom</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Catégorie</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">État</th>
                                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Dispo</th>
                                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Actions</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($equipements as $eq)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40 transition">
                                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                {{ ($equipements->currentPage() - 1) * $equipements->perPage() + $loop->iteration }}
                                            </td>

                                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-medium">
                                                {{ $eq->nom }}
                                            </td>

                                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                {{ $eq->categorie ?? '-' }}
                                            </td>

                                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                {{ $eq->etat }}
                                            </td>

                                            <td class="px-6 py-4 text-center text-sm text-gray-800 dark:text-gray-200">
                                                {{ $eq->disponibilite ? 'Oui' : 'Non' }}
                                            </td>

                                            <td class="px-6 py-4 text-center">
                                                <div class="flex justify-center gap-3">

                                                    {{-- Editer --}}
                                                    <a href="{{ route('equipements.edit', $eq) }}"
                                                       class="px-3 py-1 text-xs font-semibold rounded bg-indigo-600 hover:bg-indigo-700 text-white transition">
                                                        Éditer
                                                    </a>

                                                    {{-- Supprimer --}}
                                                    <form action="{{ route('equipements.destroy', $eq) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Supprimer cet équipement ?')">
                                                        @csrf @method('DELETE')
                                                        <button
                                                            class="px-3 py-1 text-xs font-semibold rounded bg-red-600 hover:bg-red-700 text-white transition">
                                                            Supprimer
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-6">
                            {{ $equipements->links() }}
                        </div>

                    @else

                        <p class="text-center text-gray-600 dark:text-gray-300 py-6">
                            Aucun équipement trouvé.
                        </p>

                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
