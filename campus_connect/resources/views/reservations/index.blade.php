<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestion des Réservations') }}
        </h2>
    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Message succès --}}
            @if(session('success'))
                <div class="bg-green-100/60 dark:bg-green-900/40 border-l-4 border-green-600 
                            text-green-700 dark:text-green-300 p-4 mb-6 rounded shadow">
                    {{ session('success') }}
                </div>
            @endif

            <div class="backdrop-blur-xl bg-white/50 dark:bg-gray-800/40 shadow-xl 
                        sm:rounded-lg border border-gray-200/40 dark:border-gray-700/40">

                <div class="p-6">

                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                        Liste des réservations
                    </h3>

                    {{-- Aucun résultat --}}
                    @if($reservations->isEmpty())
                        <div class="text-center p-6 rounded-lg bg-gray-100 dark:bg-gray-700/50 text-gray-600 dark:text-gray-300">
                            Aucune réservation pour le moment.
                        </div>
                    @else

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm rounded-lg overflow-hidden">

                            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold">#</th>
                                    <th class="px-4 py-3 text-left font-semibold">Utilisateur</th>
                                    <th class="px-4 py-3 text-left font-semibold">Salle</th>
                                    <th class="px-4 py-3 text-left font-semibold">Équipement</th>
                                    <th class="px-4 py-3 text-left font-semibold">Date début</th>
                                    <th class="px-4 py-3 text-left font-semibold">Date fin</th>
                                    <th class="px-4 py-3 text-left font-semibold">Statut</th>
                                    <th class="px-4 py-3 text-left font-semibold">Motif</th>
                                    <th class="px-4 py-3 text-center font-semibold">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                                @foreach ($reservations as $reservation)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40 transition">
                                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 text-gray-900 dark:text-gray-200">
                                            {{ $reservation->user->name ?? 'Utilisateur inconnu' }}
                                        </td>
                                        <td class="px-4 py-3">{{ $reservation->salle->nom ?? 'Non spécifié' }}</td>
                                        <td class="px-4 py-3">{{ $reservation->equipement->nom ?? 'Aucun' }}</td>

                                        <td class="px-4 py-3">
                                            {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}
                                        </td>

                                        <td class="px-4 py-3">
                                            @if ($reservation->statut === 'en_attente')
                                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                                    En attente
                                                </span>
                                            @elseif ($reservation->statut === 'valide')
                                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                                    Validée
                                                </span>
                                            @else
                                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                                    Rejetée
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $reservation->motif ?? '-' }}
                                        </td>

                                        <td class="px-4 py-3 text-center">

                                            {{-- Actions dynamiques --}}
                                            <div class="flex justify-center gap-2">

                                                @if ($reservation->statut == 'en_attente')

                                                    {{-- Valider --}}
                                                    <form action="{{ route('valider', $reservation->id) }}" method="POST">
                                                        @csrf @method('PATCH')
                                                        <button class="px-3 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700">
                                                            Valider
                                                        </button>
                                                    </form>

                                                    {{-- Rejeter --}}
                                                    <form action="{{ route('rejeter', $reservation->id) }}" method="POST">
                                                        @csrf @method('PATCH')
                                                        <button class="px-3 py-1 text-xs bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                                            Rejeter
                                                        </button>
                                                    </form>

                                                @endif

                                                @if ($reservation->statut == 'valide')
                                                    {{-- Rejeter --}}
                                                    <form action="{{ route('rejeter', $reservation->id) }}" method="POST">
                                                        @csrf @method('PATCH')
                                                        <button class="px-3 py-1 text-xs bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                                            Rejeter
                                                        </button>
                                                    </form>
                                                @endif

                                                {{-- Supprimer --}}
                                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST"
                                                      onsubmit="return confirm('Voulez-vous vraiment supprimer ?')">
                                                    @csrf @method('DELETE')
                                                    <button class="px-3 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700">
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

                    @endif

                </div>
            </div>
        </div>

    </div>

</x-app-layout>
