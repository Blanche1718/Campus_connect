<x-app-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une annonce</title>

    <link rel="stylesheet" href="/Bootstrap_5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        :root {
            --soft-blue: #dee2ff;
            --soft-lavender: #f0e6ff;
            --primary-color: #6c75f5;
            --text-color: #343a40;
            --card-bg: #ffffff;
            --shadow-light: 0 10px 20px rgba(108, 117, 245, 0.1);
        }
        body {
            background: linear-gradient(135deg, var(--soft-blue), var(--soft-lavender), #e9ecef);
            color: var(--text-color);
            min-height: 100vh;
            padding-top: 50px;
        }
        .modern-card {
            background-color: var(--card-bg);
            border-radius: 20px;
            box-shadow: var(--shadow-light);
            border: none;
            padding: 30px !important;
        }
    </style>
</head>

<body>

    <form action="{{ route('annonces.update', $annonce->id) }}" method="POST"
          class="form-group d-flex flex-column align-items-center">
        @csrf
        @method('PUT')

        <h1 class="text-center mb-4" style="color: var(--primary-color);">Modifier l'annonce ✏️</h1>

        <div class="container modern-card" style="max-width: 650px;">

            {{-- TITRE --}}
            <div>
                <label><strong>Titre <span class="text-danger">*</span></strong></label>
                <input type="text"
                       name="titre"
                       class="form-control @error('titre') is-invalid @enderror"
                       value="{{ old('titre', $annonce->titre) }}">
                @error('titre') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- CONTENU --}}
            <div>
                <label><strong>Contenu <span class="text-danger">*</span></strong></label>
                <textarea name="contenu"
                          rows="6"
                          class="form-control @error('contenu') is-invalid @enderror">{{ old('contenu', $annonce->contenu) }}</textarea>
                @error('contenu') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- CATEGORIE --}}
            <div>
                <label><strong>Categorie <span class="text-danger">*</span></strong></label>
                <select name="categorie_id" class="form-select @error('categorie_id') is-invalid @enderror">
                    <option value="">--Sélectionnez une categorie--</option>

                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}"
                            {{ old('categorie_id', $annonce->categorie_id) == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->nom }}
                        </option>
                    @endforeach
                </select>
                @error('categorie_id') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- DATE EVENEMENT --}}
            <div>
                <label><strong>Date de l'événement</strong></label>
                <input type="date"
                       name="date_evenement"
                       class="form-control @error('date_evenement') is-invalid @enderror"
                       value="{{ old('date_evenement', $annonce->date_evenement) }}">
                @error('date_evenement') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- SALLE --}}
            <div>
                <label><strong>Salle concernée</strong></label>
                <select name="salle_id" class="form-select @error('salle_id') is-invalid @enderror">
                    <option value="">--Sélectionnez une salle--</option>

                    @foreach ($salles as $salle)
                        <option value="{{ $salle->id }}"
                            {{ old('salle_id', $annonce->salle_id) == $salle->id ? 'selected' : '' }}>
                            {{ $salle->nom }}
                        </option>
                    @endforeach
                </select>
                @error('salle_id') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- EQUIPEMENTS --}}
            <div id="equipements-container">
                <label><strong>Équipements concernés :</strong></label>

                @php
                    // On s'assure que $selectedEquipements est toujours un tableau.
                    // (array) convertit null ou une chaîne en un tableau (potentiellement vide).
                    $selectedEquipements = (array) old('equipements', $annonce->equipements ?? []);
                @endphp

                @forelse ($selectedEquipements as $eq)
                    <div class="input-group mb-2">
                        <select name="equipements[]" class="form-select">
                            <option value="">--Sélectionnez un équipement--</option>
                            @foreach ($equipements as $equipement)
                                <option value="{{ $equipement->id }}"
                                    {{ $equipement->id == $eq ? 'selected' : '' }}>
                                    {{ $equipement->nom }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">-</button>
                    </div>
                @empty
                    {{-- Si aucun équipement n'est sélectionné, on affiche un premier champ vide --}}
                    <div class="input-group mb-2">
                        <select name="equipements[]" class="form-select">
                            <option value="">--Sélectionnez un équipement--</option>
                            @foreach ($equipements as $equipement)
                                <option value="{{ $equipement->id }}">{{ $equipement->nom }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">-</button>
                    </div>
                @endforelse

                @error('equipements.*') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <button type="button" id="add-equipement-btn" class="btn btn-outline-secondary mt-1">
                Ajouter un équipement
            </button>

            {{-- PUBLICATION : MAINTENANT OU PLANIFIER --}}
            <div class="d-flex gap-4 mt-3">
                <label>
                    <input type="radio" name="type_publication" value="maintenant"
                        {{ old('type_publication', $annonce->statut == 'publiee' ? 'maintenant' : 'planifier') == 'maintenant' ? 'checked' : '' }}>
                    Publier maintenant
                </label>

                <label>
                    <input type="radio" name="type_publication" value="planifier"
                        {{ old('type_publication', $annonce->statut == 'planifiee' ? 'planifier' : 'maintenant') == 'planifier' ? 'checked' : '' }}>
                    Planifier
                </label>
            </div>

            {{-- DATE PUBLICATION --}}
            <div id="dateHeureContainer"
                 style="display: {{ old('type_publication', $annonce->statut) == 'planifiee' ? 'block' : 'none' }};">
                <label>Date et Heure de publication</label>

                <input type="datetime-local"
                       name="date_publication"
                       class="form-control"
                       value="{{ old('date_publication', $annonce->date_publication) }}">
            </div>

            {{-- BOUTON --}}
            <div class="d-flex gap-3 justify-content-end pt-3">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-danger">
                    <i class="bi bi-x-circle"></i> Annuler
                </a>

                <input type="submit" value="Modifier l'annonce" class="btn btn-primary">
            </div>

        </div>
    </form>

    <script>
        // Ajout d’un nouvel équipement
        document.getElementById('add-equipement-btn').addEventListener('click', function () {
            const container = document.getElementById('equipements-container');
            const newGroup = document.createElement('div');
            newGroup.classList.add('input-group', 'mb-2');

            const firstSelect = container.querySelector('select');
            const newSelect = firstSelect.cloneNode(true);
            newSelect.value = '';

            const removeBtn = document.createElement('button');
            removeBtn.classList.add('btn', 'btn-danger');
            removeBtn.type = 'button';
            removeBtn.textContent = '-';
            removeBtn.onclick = () => newGroup.remove();

            newGroup.appendChild(newSelect);
            newGroup.appendChild(removeBtn);
            container.appendChild(newGroup);
        });

        // Gestion affichage planification
        const dateHeureContainer = document.getElementById('dateHeureContainer');
        const datePublicationInput = document.getElementById('date_publication');

        document.querySelectorAll('input[name="type_publication"]').forEach(r => {
            r.addEventListener('change', function () {
                if (this.value === 'planifier') {
                    dateHeureContainer.style.display = 'block';
                    datePublicationInput.setAttribute('required', true);
                } else {
                    dateHeureContainer.style.display = 'none';
                    datePublicationInput.removeAttribute('required');
                }
            });
        });
    </script>

</body>
</html>

</x-app-layout>