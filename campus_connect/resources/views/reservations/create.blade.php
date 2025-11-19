<x-app-layout>
    <x-slot name="header"><h5>Faire une réservation</h5></x-slot>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faire une réservation</title>
    <link rel="stylesheet" href="/Bootstrap_5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.css">
    
    <style>
        :root {
            /* Couleurs principales pour un look moderne et doux */
            --soft-blue: #dee2ff;
            --soft-lavender: #f0e6ff;
            --primary-color: #6c75f5; /* Bleu Lavande */
            --text-color: #343a40;
            --card-bg: #ffffff;
            --shadow-light: 0 10px 20px rgba(108, 117, 245, 0.1);
        }

        body {
            /* Fond doux et lumineux (Bleu/Lavande très pâle) */
            background: linear-gradient(135deg, var(--soft-blue), var(--soft-lavender), #e9ecef);
            color: var(--text-color);
            min-height: 100vh;
            padding-top: 50px; /* Espace pour le titre */
        }

        /* Style de la carte/Conteneur du formulaire (Soft UI) */
        .modern-card {
            background-color: var(--card-bg);
            border-radius: 20px; /* Coins très arrondis */
            box-shadow: var(--shadow-light); /* Ombre douce */
            border: none; /* Supprime la bordure par défaut de Bootstrap */
            padding: 30px !important; 
        }

        /* Amélioration de l'apparence des inputs/select */
        .form-control, .form-select {
            border-radius: 10px;
            border-color: #ced4da;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(108, 117, 245, 0.25); /* Ombre concentrée autour du bleu primaire */
        }
        
        /* Style des boutons pour plus d'attrait */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 10px;
            font-weight: 600;
            transition: background-color 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #5a63c0;
            border-color: #5a63c0;
        }
        
        .btn-outline-danger {
            border-radius: 10px;
            font-weight: 600;
        }
        
    </style>
</head>
<body>

    <form action="{{route('reservations.store')}}" method="POST" class="form-group d-flex flex-column align-items-center">
        @csrf

        <h1 class="text-center mb-4" style="color: var(--primary-color);">Faire une réservation 📝</h1>
        
        <div class="container d-flex flex-column justify-content-center modern-card gap-3" style="max-width: 650px;">
             <!-- Bloc pour afficher les messages de succès -->
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Bloc pour afficher les messages d'erreur -->
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
            <div>
                <label for="salle_id"><strong>Sélectionnez une salle: </strong></label>
                <select name="salle_id" class="form-select @error('salle_id') is-invalid @enderror">
                    <option value="">--Sélectionnez une salle--</option>
                    @foreach ($salles as $salle) 
                        <option value="{{$salle->id}}">{{$salle->nom}}</option>
                    @endforeach
                </select>
                @error('salle_id') <div class="text-danger small">{{$message}}</div> @enderror
            </div>


            <div>
                <label for="equipement_id"><strong>Sélectionnez un equipement: </strong></label>
                <select name="equipement_id" class="form-select @error('equipement_id') is-invalid @enderror">
                    <option value="">--Sélectionnez les équipements--</option>
                    @foreach ($equipements as $equipement) 
                        <option value="{{$equipement->id}}" {{old('equipement_id')==$equipement->id ? 'selected':''}}>{{$equipement->nom}}</option>
                    @endforeach
                </select>
                @error('equipement_id') <div class="text-danger small">{{$message}}</div> @enderror
            </div>
             <div>
                <label for="date_debut"><strong>Date de debut <span class="text-danger">*</span></strong></label>
                <input type="date" name="date_debut" value="{{old('date_debut')}}" class="form-control @error('date_debut') is-invalid @enderror" >
                @error('date_debut') <div class="text-danger small">{{$message}}</div> @enderror
            </div>

            <div>
                <label for="date_fin"><strong>Date de fin<span class="text-danger">*</span></strong></label>
                <input type="date" name="date_fin" value="{{old('date_fin')}}" class="form-control @error('date_fin') is-invalid @enderror" >
                @error('date_fin') <div class="text-danger small">{{$message}}</div> @enderror
            </div>

            <div>
                <label for="motif"><strong>Motif</strong></label>
                <textarea name="motif" id="" cols="30" class="form-control" rows="10"></textarea>
                @error('motif') <div class="text-danger small">{{$message}}</div> @enderror
            </div>

            <!-- associer l'id de l'utilisateur connecté au formulaire  -->
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">

            

            <div class="d-flex gap-3 justify-content-end pt-3">
                <a href="{{route('dashboard.enseignant')}}" class="btn btn-outline-danger"> <i class="bi bi-x-circle"></i> Abandonner la réservation</a>
                <input type="submit" name="submit" class="btn btn-primary" value="Faire la réservation" >
            </div>
        </div>
    </form>
</body>
</html>
</x-app-layout>
