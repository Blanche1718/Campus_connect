<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation | CampusConnect</title>

    <link rel="stylesheet" href="/Bootstrap_5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            font-weight: bold;
            margin-top: 40px;
            margin-bottom: 20px;
            text-align: center;
        }

        .card-form {
            border: none;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            background: white;
        }
    </style>
</head>

<body class="bg-white">

<!-- Navbar identique -->
<nav class="navbar navbar-expand-lg bg-light shadow-sm px-4 py-2 ">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-primary" href="#">
      <img src="{{asset('storage/photos/log.png')}}" alt="Logo" style="width:60px; height:60px;" class="me-2">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse bg-white" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>
        <li class="nav-item"><a class="nav-link active fw-bold" href="#">Réservations</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Annonces</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
      </ul>

      <a href="{{route('login')}}" class="btn btn-primary ms-lg-3">Mon Espace</a>
    </div>
  </div>
</nav>

<div class="container">

    <h2 class="page-title">📌 Nouvelle demande de réservation</h2>

    <div class="card card-form mx-auto" style="max-width: 600px;">

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf

            {{-- Sélection ressource --}}
            <label class="fw-bold">Salle ou Matériel</label>
            <select name="resource_id" class="form-control mb-3">
                @foreach ($resources as $r)
                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                @endforeach
            </select>

            {{-- Date --}}
            <label class="fw-bold">Date</label>
            <input type="date" name="date" class="form-control mb-3" required>

            <div class="row">
                <div class="col-md-6">
                    <label class="fw-bold">Heure début</label>
                    <input type="time" name="start_time" class="form-control mb-3" required>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Heure fin</label>
                    <input type="time" name="end_time" class="form-control mb-3" required>
                </div>
            </div>

            {{-- Description --}}
            <label class="fw-bold">Motif / Description</label>
            <textarea name="description" class="form-control mb-3" rows="3"></textarea>

            <button class="btn btn-primary w-100 mt-2">
                📨 Envoyer la demande
            </button>
        </form>

    </div>

</div>

<footer class="bg-light mt-5 py-3 text-center">
    <p class="text-muted mb-0">© 2025 CampusConnect | <a href="#">Politique de Confidentialité</a></p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
