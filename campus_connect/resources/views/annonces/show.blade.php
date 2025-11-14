
<!-- Afficher une annonce spécifique -->
<x-app-layout>
    <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Détails de l\'Annonce') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="/Bootstrap_5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

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
    </style>

    <body class="bg-light">
        <div class="container my-5">
            <div class="ad-card p-4">
                <span class="badge-category mb-3">{{ $annonce->categorie->nom ?? 'Non classé' }}</span>
                <h2 class="ad-title mb-3">{{ $annonce->titre }}</h2>
                <p class="ad-content mb-4">{{ $annonce->contenu }}</p>
                <div class="info-block">
                    <p><i class="bi bi-person-fill"></i> <strong>Auteur :</strong> {{ $annonce->auteur->name ?? 'Anonyme' }}</p>
                    <p><i class="bi bi-calendar-event-fill"></i> <strong>Publié le :</strong> {{ $annonce->created_at->translatedFormat('d M Y') }}</p>
                    @if($annonce->lieu)
                        <p><i class="bi bi-geo-alt-fill"></i> <strong>Lieu :</strong> {{ $annonce->lieu }}</p>
                    @endif
                    @if($annonce->date_evenement)
                        <p><i class="bi bi-clock-fill"></i> <strong>Date de l'événement :</strong> {{ \Carbon\Carbon::parse($annonce->date_evenement)->translatedFormat('d M Y') }}</p>
                    @endif
                    @if($annonce->equipements_details->isEmpty())
                        <p><i class="bi bi-cpu-fill"></i> <strong>Équipements requis :</strong> Aucune</p>
                    @else  
                        <p><i class="bi bi-cpu-fill"></i> <strong>Équipements requis :</strong></p>
                        <ul>
                            @foreach($annonce->equipements_details as $equipement)
                                <li>{{ $equipement->nom }} </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </body>
</x-app-layout>