


<x-app-layout>
   
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$salle ? "Modification de salle " : "Creation de salle" }}</title>
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

    <form action="{{ $salle ? route('edite_salle' , $salle->id) : route('salle_store')}}" method="POST" class="form-group d-flex flex-column align-items-center">
        @csrf
        @if ($salle)
            @method('PUT')
        @endif
        <h1 class="text-center mb-4" style="color: var(--primary-color);">{{$salle ? "Modification de salle" : " Créer une salle "}}</h1>
        <div class="container d-flex flex-column justify-content-center modern-card gap-3 mb-3" style="max-width: 650px;">
            
            <div>
                <label for="nom"><strong>Nom <span class="text-danger">*</span></strong> </label>
                <input type="text" name="nom" class="form-control @error ('nom') is-invalid @enderror " value="{{old ('nom' , $salle->nom ?? '') }}" placeholder="Ex: Amphi A-1000" required>
                @error('nom') <div class="text-danger small">{{$message}}</div> @enderror
            </div>

            <div>
                <label for="capacite"><strong>Capacite </strong> </label>
                <input type="number" min="20" name="capacite" class="form-control @error('capacite') is-invalid @enderror " value="{{old ('capacite' , $salle->capacite ?? '') }}" placeholder="Ex:200" required>
                @error('capacite') <div class="text-danger small">{{$message}}</div> @enderror
            </div>

            <div>
                <label for="localisation"><strong>Localisation </strong> </label>
                <input type="text" name="localisation" class="form-control @error('localisation') is-invalid @enderror " value="{{old ('localisation' , $salle->localisation ?? '') }}" placeholder="" required>
                @error('localisation') <div class="text-danger small">{{$message}}</div> @enderror
            </div>

            <div>
                <label for="description"> <strong>Description</strong> </label>
                <textarea name="description" id="description" cols="30" rows="6" class="form-control @error('description') is-invalid @enderror">{{old ('description' , $salle->description ?? '') }}</textarea>
                @error('description') <div class="text-danger small">{{$message}}</div> @enderror
            </div>

              <div>
                <label for="disponibilite"><strong>disponibilite <span class="text-danger">*</span></strong> </label>
                <select name="disponibilite" id="" class="form-control">
                    <option value="">--Sélectionner une option--</option>
                    <option value='0' {{old ('disponibilite' , $salle->disponibilite ?? '') == 0 ? 'selected' : ''}}>Indisponible</option>
                    <option value='1' {{ old('disponibilite'  , $salle->disponibilite ?? '' ) == 1 ? 'selected' : ''}}>Disponible</option>
                </select>
                @error ('disponibilite') <div class="text-danger small">{{$mesage}}</div> @enderror
            </div>
            

            <div class="d-flex gap-3 justify-content-end pt-3">
                <a href="{{route('dashboard')}}" class="btn btn-outline-danger"> <i class="bi bi-x-circle"></i> {{$salle ? "Abandonner les modifications":"Abandonner la création"}} </a>
                <input type="submit" name="submit" class="btn btn-success" value=" {{$salle ? "Enregistrer les modifications":"Créer la salle"}}" >
            </div>
           
        </div>
    </form>
</body>
</html>
    <a href="{{route('edite' , 2)}}" class="btn btn-primary">Editer une annonce</a>
</x-app-layout>
