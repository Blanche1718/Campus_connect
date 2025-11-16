<x-app-layout>
    <x-slot name="header"><h2>Créer une salle</h2></x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('salles.store') }}" method="POST" class="card p-4">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
                    @error('nom')<div class="text-red-500 small mt-1">{{ $message }}</div>@enderror
                    @error('salle_nom')<div class="text-red-500 small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Capacité</label>
                    <input type="number" name="capacite" class="form-control" value="{{ old('capacite') }}">
                    @error('capacite')<div class="text-red-500 small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Localisation</label>
                    <input type="text" name="localisation" class="form-control" value="{{ old('localisation') }}">
                    @error('localisation')<div class="text-red-500 small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                    @error('description')<div class="text-red-500 small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="disponibilite" id="disponibilite" @checked(old('disponibilite', true))>
                    <label class="form-check-label" for="disponibilite">Disponible</label>
                    @error('disponibilite')<div class="text-red-500 small mt-1">{{ $message }}</div>@enderror

                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('salles.index') }}" class="btn btn-link me-2">Annuler</a>
                    <button class="btn btn-primary">Enregistrer</button>

                </div>
            </form>
        </div>
    </div>
</x-app-layout>