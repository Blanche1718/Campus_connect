<?php

// ...existing code..
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tableau de bord administrateur') }}
        </h2>
    </x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Statistiques -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">

                <!-- Annonces -->
                <div>
                    <a href="{{ route('annonces.index') }}" class="block no-underline">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Annonces</h3>
                                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['annonces'] ?? 0 }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('annonces.create') }}" class="inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded">Créer</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Utilisateurs -->
                <div>
    
                        <a href="{{ route('users.index') }}" class="block no-underline">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Utilisateurs</h3>
                                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['users'] ?? 0 }}</p>
                                    </div>
                                    <div>
            
                                            <a href="{{ route('users.create') }}" class="inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded">Créer</a>
                                    
                                    </div>
                                </div>
                            </div>
                        </a>
                  
                </div>

                <!-- Catégories -->
                <div>
                    <a href="{{ route('categories.index') }}" class="block no-underline">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Catégories</h3>
                                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['categories'] ?? 0 }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('categories.create') }}" class="inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded">Créer</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Salles -->
                <div>
                    <a href="{{ route('salles.index') }}" class="block no-underline">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Salles</h3>
                                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['salles'] ?? 0 }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('salles.create') }}" class="inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded">Créer</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Équipements -->
                <div>
                    <a href="{{ route('equipements.index') }}" class="block no-underline">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Équipements</h3>
                                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['equipements'] ?? 0 }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('equipements.create') }}" class="inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded">Créer</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Reservations -->
                <div>
                    <a href="{{ route('index') }}" class="block no-underline">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Réservations</h3>
                                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['reservations'] ?? 0 }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('reservations.create') }}" class="inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded">Créer</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

            <!-- Dernières annonces -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Dernières annonces</h3>

                    @if(isset($recentAnnonces) && $recentAnnonces->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Titre</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Auteur</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Catégorie</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Date publication</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($recentAnnonces as $annonce)
                                        <tr>
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">{{ Str::limit($annonce->titre, 80) }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ optional($annonce->auteur)->name ?? $annonce->auteur_id }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ optional($annonce->categorie)->nom ?? $annonce->categorie_id }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ optional($annonce->date_publication)->format('Y-m-d H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-sm text-gray-600 dark:text-gray-400">Aucune annonce récente.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
