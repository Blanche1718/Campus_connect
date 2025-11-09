<x-app-layout>
    <x-slot name="header"><h2>Équipements</h2></x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('equipements.create') }}" class="btn btn-primary mb-3">Nouvel équipement</a>

            <div class="card">
                <div class="card-body">
                    @if($equipements->count())
                        <table class="table">
                            <thead>
                                <tr><th>#</th><th>Nom</th><th>Catégorie</th><th>État</th><th>Dispo</th><th>Actions</th></tr>
                            </thead>
                            <tbody>
                                @foreach($equipements as $eq)
                                    <tr>
                                        <td>{{ $eq->id }}</td>
                                        <td>{{ $eq->nom }}</td>
                                        <td>{{ $eq->categorie ?? '-' }}</td>
                                        <td>{{ $eq->etat }}</td>
                                        <td>{{ $eq->disponibilite ? 'Oui' : 'Non' }}</td>
                                        <td>
                                            <a href="{{ route('equipements.edit', $eq) }}" class="btn btn-sm btn-outline-secondary">Éditer</a>
                                            <form action="{{ route('equipements.destroy', $eq) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $equipements->links() }}
                    @else
                        <p>Aucun équipement trouvé.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>