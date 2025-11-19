<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Connect - Bienvenue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --color-primary: #4A90E2;       /* bleu doux */
            --color-secondary: #7F5AF0;     /* violet clair */
            --color-accent: #FFB6C1;        /* rose pastel */
            --color-bg: #FAFAFA;            /* fond très clair */
            --color-card-bg: #FFFFFF;       /* cartes blanches */
            --color-text: #333333;
            --card-shadow: 0 6px 20px rgba(0,0,0,0.06);
            --card-hover-shadow: 0 10px 25px rgba(0,0,0,0.12);
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--color-bg);
            color: var(--color-text);
        }

        /* Navbar */
        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .navbar-brand img { transition: transform var(--transition-speed); }
        .navbar-brand:hover img { transform: scale(1.1); }
        .nav-link.active { font-weight: 600; color: var(--color-primary); }
        .btn-primary, .btn-outline-primary { border-radius: 10px; transition: all var(--transition-speed); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(74,144,226,0.3); }

        /* Hero */
        .hero {
            position: relative;
            min-height: 450px;
            background: linear-gradient(135deg, rgba(74,144,226,0.6), rgba(127,90,240,0.6)), url('storage/photos/fond.png') center/cover no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            flex-direction: column;
            padding: 60px 20px;
        }
        .hero h1 { font-size: 2.8rem; font-weight: 700; margin-bottom: 1rem; animation: fadeInUp 1s ease forwards; }
        .hero p { font-size: 1.2rem; max-width: 650px; color: #f0f0f0; margin: 0 auto 2rem; animation: fadeInUp 1.2s ease forwards; }
        @keyframes fadeInUp { 0% {opacity:0; transform: translateY(20px);} 100% {opacity:1; transform: translateY(0);} }
        .hero form { max-width: 500px; display: flex; gap: 10px; flex-wrap: wrap; justify-content: center; animation: fadeInUp 1.4s ease forwards; }
        .hero form .form-control { border-radius: 10px; transition: all var(--transition-speed); }
        .hero form .form-control:focus { box-shadow: 0 0 10px rgba(74,144,226,0.4); border-color: var(--color-primary); }

        /* Quick Access */
        .quick-access { padding: 60px 20px; display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
        .quick-access-item { background-color: #fff; padding: 2rem; border-radius: 15px; box-shadow: var(--card-shadow); text-align: center; width: 220px; transition: all var(--transition-speed); text-decoration: none; color: var(--color-text);}
        .quick-access-item:hover { transform: translateY(-6px); box-shadow: var(--card-hover-shadow); background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); color: #fff; }
        .quick-access-item i { font-size: 2.5rem; margin-bottom: 10px; display: block; color: var(--color-primary); transition: color var(--transition-speed); }
        .quick-access-item:hover i { color: #fff; }

        /* Section Titles */
        .section-title { font-weight: 700; margin-bottom: 2rem; font-size: 1.8rem; text-align: center; position: relative; }
        .section-title::after { content:""; position:absolute; bottom:-10px; left:50%; transform:translateX(-50%); width:60px; height:3px; border-radius:2px; background-color: var(--color-primary); }

        /* Annonces Cards */
        .annonce-card { background-color: var(--color-card-bg); border-radius: 15px; box-shadow: var(--card-shadow); transition: all var(--transition-speed); display: flex; flex-direction: column; height: 100%; }
        .annonce-card:hover { transform: translateY(-5px); box-shadow: var(--card-hover-shadow); }
        .annonce-card .card-body { flex:1; display: flex; flex-direction: column; }
        .annonce-card .card-title { font-weight: 600; font-size: 1.1rem; margin-bottom: 0.5rem; }
        .annonce-card .card-text { color: #555; font-size: 0.95rem; flex-grow:1; }
        .badge-category { font-size:0.75rem; font-weight:500; padding:0.25em 0.5em; border-radius:6px; margin-bottom:0.7rem; display:inline-block; background-color: var(--color-accent); color: white; }
        .card-footer { background:none; border-top:1px solid #eee; font-size:0.8rem; color: #777; }

        /* Contacts Section */
        #contacts .annonce-card { text-align: center; padding: 1.5rem; }

        /* Footer */
        footer { background-color:#fff; padding:1.5rem 0; border-top:1px solid #e6e6e6; text-align: center; color: #555; }

        /* Responsive */
        @media(max-width: 768px){ .hero h1 {font-size:2rem;} .hero p {font-size:1rem;} .quick-access {flex-direction: column; align-items: center;} }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold text-dark" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:50px;height:50px;" class="me-2">
                CampusConnect
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link active" href="#">Accueil</a></li>
                    <!-- Quand on est pas connecté et on clique sur annonces; on doit etre redigirer vers la page de login sinon on est redirigé vers d'affiche de toutes les annonces -->
                    <li>@if(Route::has('annonces.index'))
                        <a class="nav-link" href="{{ route('annonces.index') }}">Annonces</a>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">Annonces</a>
                    @endif
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#annonces">Actualités</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contacts">Contact</a></li>
                </ul>
                <div class="ms-lg-3 d-flex align-items-center gap-2">
                    @if(Route::has('login'))
                        @auth
                            @if(Auth::user()->role->nom === 'admin')
                                <a href="{{ route('dashboard') }}" class="btn btn-primary">Mon Espace</a>
                            @elseif(Auth::user()->role->nom === 'enseignant')
                                <a href="{{ route('dashboard.enseignant') }}" class="btn btn-primary">Mon Espace</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary">Se Déconnecter</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Se Connecter</a>
                            @if(Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">S'inscrire</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero avec Formulaire -->
    <header class="hero" id="salle-search">
        <h1>L’Information Universitaire Centralisée</h1>
        <p>Restez connecté à la vie du campus et découvrez les annonces importantes en un clic.</p>
        @auth
        <form action="{{ route('salles.verifierDisponibilite') }}" method="GET">
            <input class="form-control" list="sallesOptions" name="salle_search" placeholder="Rechercher une salle..." required>
            <datalist id="sallesOptions">
                @foreach ($salles as $salle)
                <option value="{{ $salle->nom }}">
                @endforeach
            </datalist>
            <button type="submit" class="btn btn-primary mt-2 w-100">Vérifier</button>
        </form>
        @else
        <p class="mt-3"><a href="{{ route('login') }}">Connectez-vous</a> pour vérifier la disponibilité des salles.</p>
        @endauth
    </header>

    <!-- Quick Access -->
    <section class="quick-access">
        <!-- Quand on est pas connecté et on clique sur annonces; on doit etre redigirer vers la page de login sinon on est redirigé vers d'affiche de toutes les annonces -->
        <a href="{{ Route::has('annonces.index') ? route('annonces.index') : route('login') }}" class="quick-access-item"><i class="bi bi-bell"></i> Voir les Annonces</a>
        <a href="#salle-search" class="quick-access-item"><i class="bi bi-door-open"></i> Disponibilité d’une salle</a>
        <a href="#annonces" class="quick-access-item"><i class="bi bi-newspaper"></i> Actualités</a>
        <a href="#contacts" class="quick-access-item"><i class="bi bi-people"></i> Contacts</a>
        
    </section>

    <!-- Annonces -->
    <main class="container py-5" id="annonces">
        <h2 class="section-title text-center mb-4">Dernières Annonces</h2>
        <div class="row g-4">
            @forelse ($annonces as $annonce)
            <div class="col-lg-3 col-md-6">
                <div class="card annonce-card h-100">
                    <div class="card-body d-flex flex-column">
                        <span class="badge-category">{{ $annonce->categorie->nom ?? 'Non classé' }}</span>
                        <h5 class="card-title">{{ $annonce->titre }}</h5>
                        <p class="card-text">{{ Str::limit($annonce->contenu, 80) }}</p>
                        <a href="{{ route('annonces.show', $annonce->id) }}" class="btn btn-outline-primary mt-auto">Voir plus</a>
                    </div>
                    <div class="card-footer">
                        Publié par {{ $annonce->auteur->name ?? 'Anonyme' }}<br>
                        <time datetime="{{ $annonce->created_at->toIso8601String() }}">{{ $annonce->created_at->translatedFormat('d M Y') }}</time>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-muted">Aucune annonce à afficher pour le moment.</p>
            @endforelse
        </div>
    </main>

    <!-- Section Contacts -->
    <section class="py-5" id="contacts" style="background-color: #f9faff;">
        <div class="container text-center">
            <h2 class="section-title mb-4">Contacts</h2>
            <div class="row justify-content-center g-4">
                <div class="col-md-4">
                    <div class="card annonce-card p-3 h-100">
                        <h5>Email</h5>
                        <p><a href="mailto:contact@campusconnect.fr">contact@campusconnect.fr</a></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card annonce-card p-3 h-100">
                        <h5>Téléphone</h5>
                        <p><a href="tel:+33123456789">+229 01 97 69 95 79</a></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card annonce-card p-3 h-100">
                        <h5>Bureau</h5>
                        <p>IFRI, Iran2, 2ème étage</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="mb-0">© {{ date('Y') }} CampusConnect | Tous droits réservés</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
