<x-app-layout>
    <x-slot name="header"><h2>Éditer salle</h2></x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('salles.update', $salle) }}" method="POST" class="card p-4">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" value="{{ old('nom', $salle->nom) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Capacité</label>
                    <input type="number" name="capacite" class="form-control" value="{{ old('capacite', $salle->capacite) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Localisation</label>
                    <input type="text" name="localisation" class="form-control" value="{{ old('localisation', $salle->localisation) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description', $salle->description) }}</textarea>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="disponibilite" id="disponibilite" @checked(old('disponibilite', $salle->disponibilite))>
                    <label class="form-check-label" for="disponibilite">Disponible</label>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('salles.index') }}" class="btn btn-link me-2">Annuler</a>
                    <button class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>