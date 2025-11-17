<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Créer un équipement') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="backdrop-blur-xl bg-white/60 dark:bg-gray-800/50 shadow-xl border border-gray-200/40 
                        dark:border-gray-700/30 sm:rounded-lg overflow-hidden p-6">

                <form action="{{ route('equipements.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Nom --}}
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nom
                        </label>
                        <input type="text" name="nom" id="nom" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                      focus:border-blue-500 focus:ring focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-blue-500" 
                               value="{{ old('nom') }}" required>
                        @error('nom') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Catégorie --}}
                    <div>
                        <label for="categorie" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Catégorie
                        </label>
                        <input type="text" name="categorie" id="categorie" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                      focus:border-blue-500 focus:ring focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-blue-500" 
                               value="{{ old('categorie') }}">
                        @error('categorie') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- État --}}
                    <div>
                        <label for="etat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            État
                        </label>
                        <input type="text" name="etat" id="etat" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                      focus:border-blue-500 focus:ring focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-blue-500" 
                               value="{{ old('etat', 'disponible') }}">
                        @error('etat') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Description
                        </label>
                        <textarea name="description" id="description" rows="3" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                         focus:border-blue-500 focus:ring focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-blue-500">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Disponibilité --}}
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="disponibilite" id="disponibilite" 
                               class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" 
                               @checked(old('disponibilite', true))>
                        <label for="disponibilite" class="text-sm text-gray-700 dark:text-gray-300">Disponible</label>
                    </div>

                    {{-- Boutons --}}
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('equipements.index') }}" 
                           class="px-4 py-2 rounded-md text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 transition">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 rounded-md bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition">
                            Enregistrer
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
