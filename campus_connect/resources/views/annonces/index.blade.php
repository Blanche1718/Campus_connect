<x-app-layout>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Toutes les Annonces</title>
        
        <!-- Polices de caractères modernes depuis Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="/Bootstrap_5/css/bootstrap.min.css">
        <link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.css">
        <style>
            :root {
                --primary-color: #5A67D8; /* Un bleu-indigo plus profond */
                --primary-light: #E0E7FF;
                --background-color: #F7FAFC;
                --text-color: #343a40;
                --text-muted: #718096;
                --card-bg: #ffffff;
                --card-border: #E2E8F0;
                --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }
            body {
                background-color: var(--background-color);
                font-family: 'Poppins', sans-serif;
                color: var(--text-color);
            }
            .ad-card {
                background-color: var(--card-bg);
                border: 1px solid var(--card-border);
                border-radius: 1rem;
                box-shadow: var(--shadow-md);
                transition: transform 0.2s, box-shadow 0.2s;
                display: flex;
                flex-direction: column;
            }
            .ad-card:hover {
                transform: translateY(-5px);
                box-shadow: var(--shadow-lg);
            }
            .ad-title {
                color: var(--primary-color);
                font-weight: 600;
            }
            .ad-content {
                white-space: pre-wrap; /* Conserve les sauts de ligne du contenu */
                line-height: 1.7;
                color: var(--text-muted);
                flex-grow: 1;
            }
            .badge-category {
                background-color: var(--primary-light);
                color: var(--primary-color);
                font-weight: 500;
                padding: 0.5em 0.8em;
                font-size: 0.8rem;
            }
            .info-block {
                border-top: 1px solid var(--card-border);
                padding: 1rem;
                font-size: 0.9rem;
                color: var(--text-muted);
            }
            .info-block strong {
                color: var(--text-color);
                font-weight: 500;
            }
            .info-block .bi {
                margin-right: 0.5rem;
            }
            .filter-card {
                background-color: var(--card-bg);
                border-radius: 1rem;
                padding: 1.5rem;
                box-shadow: var(--shadow-md);
                margin-bottom: 2.5rem;
            }
            .btn-primary {
                background-image: linear-gradient(to right, #667EEA, #5A67D8);
                border: none;
                transition: all .3s ease;
                box-shadow: var(--shadow-md);
            }
            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: var(--shadow-lg);
            }
        </style>
    </head>
    <body>
        <div class="container py-5">
            <header class="text-center mb-5">
                <h1 class="display-4 fw-bold" style="color: var(--primary-color);">Le Mur d'Annonces</h1>
                <p class="lead" style="color: var(--text-muted);">Consultez les dernières nouvelles et événements du campus.</p>
            </header>

            <!-- Section de Filtre -->
            <!-- <div class="filter-card">
                <form action="{{ route('annonces.index') }}" method="GET" class="row g-3 align-items-center">
                    <div class="col-md-9">
                        <label for="categorie_id" class="form-label fw-semibold">Filtrer par catégorie</label>
                        <select name="categorie_id" id="categorie_id" class="form-select">
                            <option value="">Toutes les catégories</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}" {{ request('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end pt-3 pt-md-0">
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel-fill me-2"></i>Filtrer</button>
                        @if(request('categorie_id'))
                            <a href="{{ route('annonces.index') }}" class="btn btn-light ms-2" title="Réinitialiser le filtre">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div> -->

        {{-- FILTER BAR --}}
        <div class="bg-white shadow-md rounded-xl p-6 mb-10">
            <form method="GET" action="{{ route('annonces.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-6">

                {{-- CATÉGORIE --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Catégorie</label>
                    <select name="categorie_id" class="w-full rounded-lg border-gray-300">
                        <option value="">Toutes les catégories</option>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}" @selected(request('categorie_id') == $categorie->id)>
                                {{ $categorie->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- AUTEUR --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Auteur</label>
                    <select name="auteur_id" class="w-full rounded-lg border-gray-300">
                        <option value="">Tous les auteurs</option>
                        @foreach ($auteurs as $auteur)
                            <option value="{{ $auteur->id }}" @selected(request('auteur_id') == $auteur->id)>
                                {{ $auteur->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- DATE --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Date</label>
                    <input type="date" name="date_publication" value="{{ request('date_publication') }}"
                           class="w-full rounded-lg border-gray-300">
                </div>

                {{-- TRI --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Trier par</label>
                    <select name="tri" class="w-full rounded-lg border-gray-300">
                        <option value="">Par défaut</option>
                        <option value="recent" @selected(request('tri')=='recent')>Plus récent → ancien</option>
                        <option value="ancien" @selected(request('tri')=='ancien')>Plus ancien → récent</option>
                    </select>
                </div>

                {{-- ACTIONS --}}
                <div class="md:col-span-4 flex gap-4">
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition">
                        Filtrer
                    </button>

                    @if(request()->anyFilled(['categorie_id','auteur_id','date_publication','tri']))
                        <a href="{{ route('annonces.index') }}"
                           class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                            Réinitialiser
                        </a>
                    @endif
                </div>

            </form>
        </div>
            <!-- Liste des Annonces -->
            <div class="row gy-5">
                @forelse ($annonces as $annonce)
                    <div class="col-12">
                        <article class="ad-card">
                            <div class="p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h2 class="ad-title mb-0">{{ $annonce->titre }}</h2>
                                    @if($annonce->categorie)
                                        <span class="badge badge-category flex-shrink-0 ms-3">{{ $annonce->categorie->nom }}</span>
                                    @endif
                                </div>

                                <div class="small mb-4" style="color: var(--text-muted);">
                                    <i class="bi bi-person-fill"></i> Publié par <strong>{{ $annonce->auteur->name }}</strong>
                                    <span class="mx-2">|</span>
                                    <i class="bi bi-clock-fill"></i> {{ $annonce->date_publication->format('d/m/Y à H:i') }}
                                </div>

                                <p class="ad-content">{{ $annonce->contenu }}</p>

                                @if (auth()->id() == 1)
                                    <div class="d-flex justify-content-end gap-3 mb-3 ">
                                        <div>
                                            <a href="{{route('annonces.edit' , $annonce->id)}}" class="btn btn-info">Modifier</a>
                                        </div>
                                        <form action="{{route('annonces.destroy' , $annonce->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" ><span class="btn btn-danger">Supprimer</span></button>
                                        </form>
                                    </div>
                                @endif
                            </div>

                            <footer class="info-block mt-auto">
                                <div class="row g-3">
                                    @if($annonce->date_evenement)
                                        <div class="col-md-4">
                                            <i class="bi bi-calendar-event" style="color: var(--primary-color);"></i>
                                            <strong>Événement le :</strong> {{ $annonce->date_evenement->format('d/m/Y') }}
                                        </div>
                                    @endif
                                    @if($annonce->salle)
                                        <div class="col-md-4">
                                            <i class="bi bi-geo-alt-fill" style="color: #38A169;"></i>
                                            <strong>Lieu :</strong> {{ $annonce->salle->nom }}
                                        </div>
                                    @endif
                                    <div class="col-md-4">
                                        <i class="bi bi-envelope-fill" style="color: #DD6B20;"></i>
                                        <strong>Contact :</strong> <a href="mailto:{{ $annonce->auteur->email }}">{{ $annonce->auteur->email }}</a>
                                    </div>
                                    @if(!$annonce->equipements_details->isEmpty())
                                        <div class="col-12 mt-3">
                                            <i class="bi bi-cpu-fill" style="color: #0BC5EA;"></i>
                                            <strong>Équipements requis :</strong>
                                            @foreach($annonce->equipements_details as $equipement)
                                                <span class="badge bg-light text-dark border ms-1 fw-normal">{{ $equipement->nom }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </footer>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5 bg-white rounded-3 shadow-sm">
                            <i class="bi bi-wind" style="font-size: 4rem; color: #A0AEC0;"></i>
                            <h4 class="mt-3 fw-light" style="color: var(--text-color);">C'est bien calme par ici...</h4>
                            <p style="color: var(--text-muted);">
                                @if(request('categorie_id'))
                                    Il n'y a pas d'annonce qui répond à votre recherche pour le moment.
                                @else
                                    Aucune annonce n'a encore été publiée.
                                @endif
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </body>
    </html>
</x-app-layout>
