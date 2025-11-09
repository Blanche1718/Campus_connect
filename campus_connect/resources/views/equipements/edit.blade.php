<x-app-layout>
    <x-slot name="header"><h2>Éditer équipement</h2></x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('equipements.update', $equipement) }}" method="POST" class="card p-4">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" value="{{ old('nom', $equipement->nom) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Catégorie</label>
                    <input type="text" name="categorie" class="form-control" value="{{ old('categorie', $equipement->categorie) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">État</label>
                    <input type="text" name="etat" class="form-control" value="{{ old('etat', $equipement->etat) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description', $equipement->description) }}</textarea>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="disponibilite" id="disponibilite" @checked(old('disponibilite', $equipement->disponibilite))>
                    <label class="form-check-label" for="disponibilite">Disponible</label>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('equipements.index') }}" class="btn btn-link me-2">Annuler</a>
                    <button class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>