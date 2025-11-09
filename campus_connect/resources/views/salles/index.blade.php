<x-app-layout>
    <x-slot name="header"><h2>Salles</h2></x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('salles.create') }}" class="btn btn-primary mb-3">Nouvelle salle</a>

            <div class="card">
                <div class="card-body">
                    @if($salles->count())
                        <table class="table">
                            <thead>
                                <tr><th>#</th><th>Nom</th><th>Capacité</th><th>Localisation</th><th>Dispo</th><th>Actions</th></tr>
                            </thead>
                            <tbody>
                                @foreach($salles as $salle)
                                    <tr>
                                        <td>{{ $salle->id }}</td>
                                        <td>{{ $salle->nom }}</td>
                                        <td>{{ $salle->capacite ?? '-' }}</td>
                                        <td>{{ $salle->localisation ?? '-' }}</td>
                                        <td>{{ $salle->disponibilite ? 'Oui' : 'Non' }}</td>
                                        <td>
                                            <a href="{{ route('salles.edit', $salle) }}" class="btn btn-sm btn-outline-secondary">Éditer</a>
                                            <form action="{{ route('salles.destroy', $salle) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $salles->links() }}
                    @else
                        <p>Aucune salle trouvée.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>