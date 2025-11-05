

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Campus Connect</title>
        
        <link rel="stylesheet" href="/Bootstrap_5/css/bootstrap.min.css">
           <link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.css">
    </head>
  <style>
    body {
      background-color: #f8f9fa;
    }

    /* Barre de navigation */
    .navbar {
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Section image (Hero) */
    .hero {
      position: relative;
      width: 100%;
      height: 380px;
      background: url('storage/photos/fond.png') ;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .hero::before {
      content: "";
      position: absolute;
      inset: 4;
      background: rgba(0, 0, 0, 0.4); /* assombrit l'image pour rendre le texte lisible */
    }

    .hero h1 {
      position: relative;
      color: white;
      font-size: 2rem;
      font-weight: bold;
      padding: 15px 30px;
      border-radius: 10px;
    }

    /* Cartes d'annonces */
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    /* Accès rapide */
    .quick-access i {
      font-size: 2rem;
      color: #0d6efd;
      margin-bottom: 10px;
    }

    /* Pied de page */
    footer {
      background-color: #fff;
      text-align: center;
      padding: 20px 0;
      font-size: 0.9rem;
      color: #6c757d;
      box-shadow: 0 -1px 3px rgba(0, 0, 0, 0.05);
    }
  </style>
<body class="bg-white">

  <!-- Navbar -->
 <!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-light shadow-sm px-4 py-2 ">
  <div class="container-fluid">
    <!-- Logo / Nom -->
    <a class="navbar-brand fw-bold text-primary" href="#">
      <img src="{{asset('storage/photos/log.png')}}" alt="Logo" style="width: 60px ; height:60px;" class="me-2">
    </a>

    <!-- Bouton menu mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Liens de navigation -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Annonces</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Actualités</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>

      <!-- Bouton "Mon espace" -->
      <a href="{{route('login')}}" class="btn btn-primary ms-lg-3">Mon Espace</a>
    </div>
  </div>
</nav>


  <!-- Image avec texte -->
  <section class="hero mt-5">
    <h1 id="h1">L’Information Universitaire Centralisée</h1>
  </section>

  <!-- Section Annonces -->
  <div class="container my-5">
    <h4 class="mb-4">📢 Les dernières annonces</h4>
    <div class="row g-4">

       

      <div class="col-md-3">
        <div class="card p-3">
          <span class="badge bg-danger mb-2">Faculté</span>
          <h6 class="fw-bold">Dates d’inscription examens</h6>
          <p class="text-muted small">Rentrée et reprise des cours annoncées.</p>
          <small class="text-secondary">Publié le 29 Oct 2025</small>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3">
          <span class="badge bg-success mb-2">Faculté</span>
          <h6 class="fw-bold">Dates d’inscription examens</h6>
          <p class="text-muted small">Rentrée et reprise des cours annoncées.</p>
          <small class="text-secondary">Publié le 29 Oct 2025</small>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card p-3">
          <span class="badge bg-primary mb-2">Admin</span>
          <h6 class="fw-bold">Dates d’inscription aux examens</h6>
          <p class="text-muted small">Réservez vos places en avance.</p>
          <small class="text-secondary">Publié le 29 Oct 2025</small>
        </div>
      </div>

      <div class="col-md-3">
        <button class="btn">
            <div class="card p-3">
          <span class="badge bg-warning text-dark mb-2">Faculté</span>
          <h6 class="fw-bold">Soirée Gala Annulée - IA & Ethnic</h6>
          <p class="text-muted small">L’évènement est reporté à une date ultérieure.</p>
          <small class="text-secondary">Publié le 29 Oct 2025</small>
        </div>
        </button>
      </div>

    </div>

    <div class="text-center mt-4">
      <a href="#" class="btn btn-primary">Voir toutes les annonces</a>
    </div>
  </div>

  <!-- Section Accès Rapide -->
  <div class="container text-center my-5">
    <h4 class="mb-4">⚡ Accès Rapide</h4>
    <div class="row quick-access justify-content-center g-4">
      <div class="col-md-3">
        <i class="bi bi-calendar-event"></i>
        <h6>Calendrier Académique</h6>
      </div>
      <div class="col-md-3">
        <i class="bi bi-laptop"></i>
        <h6>Plateforme de Cours (LMS)</h6>
      </div>
      <div class="col-md-3">
        <i class="bi bi-headset"></i>
        <h6>Support Technique</h6>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-light">
    <p>© 2025 CampusConnect | <a href="#">Politique de Confidentialité</a></p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>