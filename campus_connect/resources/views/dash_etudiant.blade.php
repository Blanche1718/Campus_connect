<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mon Tableau de Bord Etudiant') }}
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
            .btn-favoris {
    border: none;
    background: none;
    cursor: pointer;
    font-size: 1.1rem;
    color: #888;
    transition: .2s;
}

.btn-favoris.is-fav {
    color: red;
    font-weight: bold;
}
        </style>
    @endpush

    
<div class="container py-4">

    <h2 class="mb-4">Mes annonces favorites</h2>

    <div class="row">
        @forelse ($favoriteAnnonces as $annonce)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">

                    <div class="card-body">
                        <a href="{{route('annonces.show' , $annonce->id)}}" class="text-info text-decoration-none">
                            
                        <h5 class="card-title"><i class="bi bi-star-fill text-warning"></i>  {{ $annonce->titre }}</h5> <br>
                    </a>
                    <p class="m-1 card-text">{{ Str::limit($annonce->contenu, 80) }}</p>

                        <!-- Bouton favoris -->
                        <button class="btn-favoris text-danger {{ $annonce->isFavoritedBy(auth()->id()) ? '' : '' }}"
                                data-id="{{ $annonce->id }}">
                                Retirer des favoris
                            
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Aucune annonce favorite pour le moment.</p>
        @endforelse
    </div>
</div>


{{-- SCRIPT AJAX FAVORIS --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll('.btn-favoris');

    buttons.forEach(btn => {
        btn.addEventListener("click", async () => {

            const annonceId = btn.dataset.id;

            const response = await fetch(`/annonces/${annonceId}/favorite`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            });

            // Peu importe le résultat, recharge la page
            location.reload();
        });
    });
});
</script>
</x-app-layout>