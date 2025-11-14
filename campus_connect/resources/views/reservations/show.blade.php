
<!-- Afficher une annonce spécifique -->
<x-app-layout>
    <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Détails de la reservation') }}
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
                <h1 class="ad-title mb-3">Réservation pour la salle : {{ $reservation->salle->nom }}</h1>
                <div class="ad-content mb-4">
                    
                    <p><strong>Objectif :</strong> {{ $reservation->motif }}</p>
                    <p><strong>Date de début :</strong> {{ $reservation->date_debut }}</p>
                    <p><strong>Date de fin :</strong> {{ $reservation->date_fin }}</p>
                    <p><strong>Statut :</strong> {{ ucfirst($reservation->statut) }}</p>
                    
                </div>
                
            </div>
        </div>
    </body>
</x-app-layout>