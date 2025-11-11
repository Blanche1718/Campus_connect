
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Connect - Bienvenue</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --light-gray: #f8f9fa;
            --text-color: #212529;
            --card-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            --card-hover-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-gray);
            color: var(--text-color);
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .hero {
            position: relative;
            height: 400px;
            background: url('storage/photos/fond.png') center center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.5);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 2.8rem;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 1rem auto 0;
        }

        .section-title {
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 2.5rem;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        .annonce-card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .annonce-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-hover-shadow);
        }
        
        .annonce-card .card-body {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .annonce-card .card-title {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .annonce-card .card-text {
            font-size: 0.9rem;
            flex-grow: 1;
        }

        .annonce-card .card-footer {
            background: none;
            border-top: 1px solid #eee;
            font-size: 0.8rem;
            color: var(--secondary-color);
        }

        .quick-access-item {
            background-color: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
        }

        .quick-access-item:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-hover-shadow);
            background-color: var(--primary-color);
            color: white;
        }

        .quick-access-item i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            display: block;
            color: var(--primary-color);
            transition: color 0.3s ease;
        }

        .quick-access-item:hover i {
            color: white;
        }

        footer {
            background-color: #fff;
            border-top: 1px solid #e9ecef;
        }
    </style>
</head>

<body>


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <img src="{{ asset('storage/photos/log.png') }}" alt="Logo" style="width: 50px; height: 50px;" class="me-2">
                CampusConnect
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('annonces.index') }}">Annonces</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Actualités</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>
                <a href="{{ route('login') }}" class="btn btn-primary ms-lg-3">Mon Espace</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-content">
            <h1>L’Information Universitaire Centralisée</h1>
            <p>Restez connecté à la vie du campus. Consultez les dernières annonces, réservez des salles et ne manquez aucun événement important.</p>
        </div>
    </header>

    <!-- Section Annonces -->
    <main class="container my-5 py-4">
        <div class="text-center">
            <h2 class="section-title"> Dernières Annonces</h2>
        </div>
        <div class="row g-4">
            @forelse ($annonces as $annonce)
            <div class="col-lg-3 col-md-6">
                <div class="card annonce-card">
                    <div class="card-body">
                        <span class="badge bg-primary-soft bg-opacity-10 text-primary mb-2 align-self-start">{{ $annonce->categorie ->nom ?? 'Non classé' }}</span>
                        <h5 class="card-title">{{ $annonce->titre }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($annonce->contenu, 80) }}</p>
                    </div>
                    <div class="card-footer">
                        Publié par {{ $annonce->user->name ?? 'Anonyme' }}
                        <br>
                        <time datetime="{{ $annonce->created_at->toIso8601String() }}">{{ $annonce->created_at->translatedFormat('d M Y') }}</time>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center text-muted">Aucune annonce à afficher pour le moment.</p>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('annonces.index') }}" class="btn btn-outline-primary">Voir toutes les annonces</a>
        </div>
    </main>


    <!-- Section Accès Rapide -->
    <section class="py-5" style="background-color: #ffffff;">
        <div class="container text-center">
            <h2 class="section-title">⚡ Accès Rapide</h2>
            <div class="row justify-content-center g-4">
                <div class="col-md-3">
                    <a href="#" class="text-decoration-none">
                        <div class="quick-access-item">
                            <i class="bi bi-calendar-event"></i>
                            <h6 class="mb-0">Calendrier Académique</h6>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="text-decoration-none">
                        <div class="quick-access-item">
                            <i class="bi bi-laptop"></i>
                            <h6 class="mb-0">Plateforme de Cours</h6>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="text-decoration-none">
                        <div class="quick-access-item">
                            <i class="bi bi-headset"></i>
                            <h6 class="mb-0">Support Technique</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4">
        <div class="container">
            <p class="text-center text-muted mb-0">© {{ date('Y') }} CampusConnect | Tous droits réservés | <a href="#">Politique de Confidentialité</a></p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
    

   