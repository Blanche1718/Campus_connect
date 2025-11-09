<x-app-layout>
    <x-slot name="header"><h2>Éditer catégorie</h2></x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('categories.update', $category) }}" method="POST" class="card p-4">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" value="{{ old('nom', $category->nom) }}" required>
                    @error('nom')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('categories.index') }}" class="btn btn-link me-2">Annuler</a>
                    <button class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>