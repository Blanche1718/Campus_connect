<x-app-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creation d'annonce</title>
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

    {{now()}}
    <form action="{{route('annonces.store')}}" method="POST" class="form-group d-flex flex-column align-items-center">
        @csrf

        <h1 class="text-center mb-4" style="color: var(--primary-color);">Créer une annonce 📝</h1>
        <div class="container d-flex flex-column justify-content-center modern-card gap-3" style="max-width: 650px;">
            
            <div>
                <label for="titre"><strong>Titre <span class="text-danger">*</span></strong> </label>
                <input type="text" name="titre" class="form-control @error('titre') is-invalid @enderror " value="{{old ('titre') }}" placeholder="Ex: Examen de fin de semestre">
                @error('titre') <div class="text-danger small">{{$message}}</div> @enderror
            </div>

            <div>
                <label for="contenu"> <strong>Contenu<span class="text-danger">*</span></strong> </label>
                <textarea name="contenu" id="contenu" cols="30" rows="6" class="form-control @error('contenu') is-invalid @enderror">{{old('contenu')}}</textarea>
                @error('contenu') <div class="text-danger small">{{$message}}</div> @enderror
            </div>

            <div>
                <label for="Categorie"><strong>Categorie <span class="text-danger">*</span></strong></label>
                <select name="categorie_id" class="form-select @error('categorie_id') is-invalid @enderror">
                    <option value="">--Sélectionnez une categorie--</option>
                    @foreach ($categories as $categorie)
                        <option value="{{$categorie->id}}">{{$categorie->nom}}</option>
                    @endforeach
                </select>
                @error('categorie_id') <div class="text-danger small">{{$message}}</div> @enderror
            </div>


            <!--Date de l'evenement -->
            <div>
                <label for="date_evenement"><strong>Date de l'événement</strong></label>
                <input type="date" name="date_evenement" value="{{old('date_evenement')}}" class="form-control @error('date_evenement') is-invalid @enderror" >
                @error('date_evenement') <div class="text-danger small">{{$message}}</div> @enderror
            </div>


            <div>
                <label for="salle_id"><strong>Sélectionnez une salle si concernée</strong></label>
                <select name="salle_id" class="form-select @error('salle_id') is-invalid @enderror">
                    <option value="">--Sélectionnez une salle--</option>
                    @foreach ($salles as $salle) <option value="{{$salle->id}}">{{$salle->nom}}</option>
                    @endforeach
                </select>
                @error('salle_id') <div class="text-danger small">{{$message}}</div> @enderror
            </div>


            <div id="equipements-container">
                <label><strong>Sélectionnez les équipements concernés:</strong></label>
                <div class="input-group mb-2">
                    <select name="equipements[]" class="form-select @error('equipements.*') is-invalid @enderror">
                        <option value="">--Sélectionnez un équipement--</option>
                        @foreach ($equipements as $equipement)
                            <option value="{{$equipement->id}}">{{$equipement->nom}}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">-</button>
                </div>
                @error('equipements.*') <div class="text-danger small">{{$message}}</div> @enderror
            </div>
            <button type="button" id="add-equipement-btn" class="btn btn-outline-secondary align-self-start">Ajouter un autre équipement</button>


            <!-- Choix de l'option de publication -->
            <div class="d-flex gap-3">
                <label>
                    <input type="radio" name="type_publication" value="maintenant" checked>
                    Publier maintenant
                </label>
                <label>
                    <input type="radio" name="type_publication" value="planifier">
                    Planifier la publication
                </label>
            </div>

            <!-- Champ Date/Heure (initialement masqué) -->
            <div id="dateHeureContainer" style="display: none;">
                <label for="date_publication">Date et Heure de publication</label>
                <input type="datetime-local" class="form-control" name="date_publication" id="date_publication" value="{{ old('date_publication') }}">
            </div>
            <div class="d-flex gap-3 justify-content-end pt-3">
                <a href="{{route('dashboard')}}" class="btn btn-outline-danger"> <i class="bi bi-x-circle"></i> Abandonner la publication</a>
                <input type="submit" name="submit" class="btn btn-primary" value="Publier l'annonce" >
            </div>
        </div>
    </form>

    <script>
        document.getElementById('add-equipement-btn').addEventListener('click', function() {
            const container = document.getElementById('equipements-container');
            const newSelectGroup = document.createElement('div');
            newSelectGroup.classList.add('input-group', 'mb-2');

            // Cloner la première liste déroulante pour garder les options
            const firstSelect = container.querySelector('select');
            const newSelect = firstSelect.cloneNode(true);
            newSelect.value = ''; // Réinitialiser la sélection

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.classList.add('btn', 'btn-danger');
            removeBtn.textContent = '-';
            removeBtn.onclick = function() { this.parentElement.remove(); };

            newSelectGroup.appendChild(newSelect);
            newSelectGroup.appendChild(removeBtn);
            container.appendChild(newSelectGroup);
        });

            // Ciblage des éléments
        const annonceForm = document.getElementById('annonceForm');
        const dateHeureContainer = document.getElementById('dateHeureContainer');
        const datePublicationInput = document.getElementById('date_publication');
        const radioButtons = document.querySelectorAll('input[name="type_publication"]');

        // Écoute des changements sur les boutons radio pour afficher/masquer le champ date
        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'planifier') {
                    dateHeureContainer.style.display = 'block';
                    // Rendre le champ requis si planifié
                    datePublicationInput.setAttribute('required', true); 
                } else {
                    dateHeureContainer.style.display = 'none';
                    // Retirer l'attribut requis si publication immédiate
                    datePublicationInput.removeAttribute('required');
                }
            });
        });
    </script>
</body>
</html>
</x-app-layout>
