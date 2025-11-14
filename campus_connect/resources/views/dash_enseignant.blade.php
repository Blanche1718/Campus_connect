<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mon Tableau de Bord Enseignant') }}
        </h2>
    </x-slot>

    {{-- On inclut Bootstrap et les icônes pour un design plus riche --}}
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <style>
            .stat-card {
                background-color: #fff;
                border-radius: 0.75rem;
                padding: 1.5rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                display: flex;
                align-items: center;
            }
            .stat-card .icon {
                font-size: 2.5rem;
                margin-right: 1rem;
                padding: 1rem;
                border-radius: 50%;
                color: #fff;
            }
            .stat-card .icon-annonces { background-color: #4A5568; }
            .stat-card .icon-reservations { background-color: #38A169; }
        </style>
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container-fluid">

                <!-- Section Statistiques -->
                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <div class="stat-card">
                            <div class="icon icon-annonces"><i class="bi bi-megaphone-fill"></i></div>
                            <div>
                                <div class="fs-4 fw-bold">{{ $stats['mes_annonces'] }}</div>
                                <div class="text-muted">Annonces publiées</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card">
                            <div class="icon icon-reservations"><i class="bi bi-calendar-check-fill"></i></div>
                            <div>
                                <div class="fs-4 fw-bold">{{ $stats['mes_reservations'] }}</div>
                                <div class="text-muted">Réservations</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-5">
                    <!-- Colonne Mes Dernières Annonces -->
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="fw-bold mb-0">Mes annonces</h3>
                            <a href="{{ route('annonces.create') }}" class="btn btn-primary btn-sm">Créer une annonce</a>
                        </div>
                        <div class="list-group">
                            @forelse ($annonces as $annonce)
                                <a href="{{ route('annonces.show', $annonce) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $annonce->titre }}</h5>
                                        <small class="text-muted">{{ $annonce->date_publication->diffForHumans() }}</small>
                                    </div>

                                    <p class="mb-1 text-muted">{{ Str::limit($annonce->contenu, 100) }}</p>
                                    @if($annonce->categorie)
                                        <small><span class="badge bg-secondary fw-normal">{{ $annonce->categorie->nom }}</span></small>
                                    @endif
                                </a>
                            @empty
                                <div class="list-group-item text-center">
                                    <p class="mb-0 text-muted">Vous n'avez publié aucune annonce.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Colonne Mes Prochaines Réservations -->
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="mb-4 fw-bold">Mes réservations</h3>
                        <a href="{{ route('reservations.create') }}" class="btn btn-primary btn-sm">Faire une reservation</a>
                        </div>
                        <div class="list-group">
                            @forelse ($reservations as $reservation)

                                <a href="{{ route('reservations.show', $reservation) }}" class="list-group-item list-group-item-action">
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $reservation->salle->nom ?? 'Salle non spécifiée' }}</h5>
                                        <small class="text-success fw-bold">{{ \Carbon\Carbon::parse($reservation->date_debut )->format('d/m/Y') }}</small>
                                    </div>
                                    <p class="mb-1 text-muted">Motif : "{{ $reservation->motif }}"</p>
                                    <!-- statut de la réservation -->
                                    <p><strong>Statut :</strong> {{ ucfirst($reservation->statut) }}</p>
                                
                                
                                </div>
                            @empty
                                <div class="list-group-item text-center">
                                    <p class="mb-0 text-muted">Vous n'avez aucune réservation à venir.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>