<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
            <span class="text-blue-600">●</span> Tableau de bord administrateur
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Bloc pour afficher les messages de succès -->
            <!-- @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/40 border border-green-300 dark:border-green-700 rounded-lg shadow text-green-800 dark:text-green-200">
                    {{ session('success') }}
                </div>
            @endif -->
            <!-- Fin du bloc de succès -->

            <!-- Bloc pour afficher les erreurs d'importation -->
            @if (session('import_errors'))
                <div
                    class="mb-6 p-4 bg-red-100 dark:bg-red-900/40 border border-red-300 dark:border-red-700 rounded-lg shadow">
                    <h4 class="font-bold text-red-800 dark:text-red-200">Erreurs lors de l'importation</h4>
                    <ul class="mt-2 list-disc list-inside text-sm text-red-700 dark:text-red-300">
                        @foreach (session('import_errors') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Fin du bloc d'erreurs -->

            <!-- 📊 STATISTIQUES AMÉLIORÉES -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">

                @php
                    $colors = [
                        'blue' =>
                            'from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/30 text-blue-700 dark:text-blue-300',
                        'violet' =>
                            'from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/30 text-purple-700 dark:text-purple-300',
                        'green' =>
                            'from-emerald-50 to-emerald-100 dark:from-emerald-900/20 dark:to-emerald-800/30 text-emerald-700 dark:text-emerald-300',
                        'amber' =>
                            'from-amber-50 to-amber-100 dark:from-amber-900/20 dark:to-amber-800/30 text-amber-700 dark:text-amber-300',
                        'pink' =>
                            'from-pink-50 to-pink-100 dark:from-pink-900/20 dark:to-pink-800/30 text-pink-700 dark:text-pink-300',
                    ];

                    $items = [
                        [
                            'label' => 'Annonces',
                            'count' => $stats['annonces'] ?? 0,
                            'route' => 'annonces.index',
                            'create' => 'annonces.create',
                            'icon' => 'megaphone',
                        ],
                        [
                            'label' => 'Utilisateurs',
                            'count' => $stats['users'] ?? 0,
                            'route' => 'users.index',
                            'create' => 'users.create',
                            'icon' => 'users',
                        ],
                        [
                            'label' => 'Catégories',
                            'count' => $stats['categories'] ?? 0,
                            'route' => 'categories.index',
                            'create' => 'categories.create',
                            'icon' => 'tag',
                        ],
                        [
                            'label' => 'Salles',
                            'count' => $stats['salles'] ?? 0,
                            'route' => 'salles.index',
                            'create' => 'salles.create',
                            'icon' => 'building-office',
                        ],
                        [
                            'label' => 'Équipements',
                            'count' => $stats['equipements'] ?? 0,
                            'route' => 'equipements.index',
                            'create' => 'equipements.create',
                            'icon' => 'cpu-chip',
                        ],
                        [
                            'label' => 'Réservations',
                            'count' => $stats['reservations'] ?? 0,
                            'route' => 'reservations.index',
                            'create' => 'reservations.create',
                            'icon' => 'calendar',
                        ],
                    ];
                @endphp

                @foreach ($items as $index => $item)
                    @php
                        $color = array_values($colors)[$index % count($colors)];
                    @endphp

                    <a href="{{ route($item['route']) }}">
                        <div
                            class="relative p-6 bg-gradient-to-br {{ $color }}
                            rounded-xl shadow-md border border-gray-200 dark:border-gray-700
                            hover:shadow-2xl hover:-translate-y-1 transform transition-all duration-300
                            backdrop-blur-lg">

                            <!-- Icône -->
                            <div
                                class="absolute top-4 right-4 p-3 rounded-xl bg-white/70 dark:bg-gray-900/40 shadow
                                ring-1 ring-black/5">
                                <x-dashboard-icon :icon="$item['icon']" />
                            </div>

                            <h3 class="text-sm font-semibold opacity-80">{{ $item['label'] }}</h3>

                            <p class="mt-2 text-4xl font-extrabold text-gray-900 dark:text-white drop-shadow-sm">
                                {{ $item['count'] }}
                            </p>

                            <div class="mt-5">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <a href="{{ route($item['create']) }}"
                                        class="inline-block bg-black/10 dark:bg-white/10 hover:bg-black/20 dark:hover:bg-white/20
                                              transition text-xs px-3 py-1 rounded-lg font-medium backdrop-blur-md">
                                        + Créer
                                    </a>
                                    @if ($item['label'] === 'Utilisateurs')
                                        <div class="flex items-center gap-2 mt-2 sm:mt-0">
                                            <a href="{{ route('users.download-template') }}"
                                                class="inline-flex items-center gap-1 bg-black/10 dark:bg-white/10 hover:bg-black/20 dark:hover:bg-white/20 transition text-xs px-3 py-1 rounded-lg font-medium backdrop-blur-md"
                                                title="Télécharger le modèle">
                                                <x-heroicon-o-arrow-down-tray class="w-3 h-3" />
                                                <span>Modèle</span>
                                            </a>
                                            <form action="{{ route('users.import') }}" method="POST"
                                                enctype="multipart/form-data" class="inline-flex">
                                                @csrf
                                                <label for="file-upload"
                                                    class="cursor-pointer inline-flex items-center gap-1 bg-blue-100 dark:bg-blue-900/40 hover:bg-blue-200 dark:hover:bg-blue-800/50 transition text-xs px-3 py-1 rounded-lg font-medium backdrop-blur-md text-blue-700 dark:text-blue-300">
                                                    <x-heroicon-o-arrow-up-tray class="w-3 h-3" />
                                                    <input id="file-upload" name="file" type="file"
                                                        class="sr-only" onchange="this.form.submit()">
                                                    <span>Importer</span>
                                                </label>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>

            <!-- ⏳ RÉSERVATIONS EN ATTENTE -->
            <div
                class="bg-white dark:bg-gray-900 rounded-xl shadow-xl border border-gray-200 dark:border-gray-800 overflow-hidden backdrop-blur-xl">
                <div class="p-6">

                    <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <x-heroicon-o-clock class="w-6 h-6 text-amber-500" />
                        Réservations en attente
                    </h3>

                    @if (isset($pendingReservations) && $pendingReservations->count())
                        <div class="overflow-x-auto mt-6">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800/50">
                                    <tr>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                                            Utilisateur</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                                            Salle</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                                            Equipement</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                                            Période</th>
                                        <th
                                            class="px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($pendingReservations as $reservation)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                            <td class="px-4 py-3 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ optional($reservation->user)->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                                {{ $reservation->salle->nom ?? 'N/A' }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                                {{ $reservation->equipement->nom ?? 'N/A' }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                                {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/y') }}
                                                - {{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/y') }}
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <div class="flex justify-center items-center gap-2">
                                                    {{-- Valider --}}
                                                    <form action="{{ route('valider', $reservation->id) }}"
                                                        method="POST">
                                                        @csrf @method('PATCH')
                                                        <button
                                                            class="px-3 py-1 text-xs font-semibold rounded bg-green-600 hover:bg-green-700 text-white transition">
                                                            Valider
                                                        </button>
                                                    </form>

                                                    {{-- Rejeter --}}
                                                    <form action="{{ route('rejeter', $reservation->id) }}"
                                                        method="POST">
                                                        @csrf @method('PATCH')
                                                        <button
                                                            class="px-3 py-1 text-xs font-semibold rounded bg-red-600 hover:bg-red-700 text-white transition">
                                                            Rejeter
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 dark:text-gray-400">Aucune réservation en attente pour le moment.
                            </p>
                            <x-heroicon-o-check-circle class="w-12 h-12 mx-auto mt-4 text-green-400" />
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
