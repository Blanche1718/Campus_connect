<x-app-layout>
    <x-slot name="header"><h2>Catégories</h2></x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Nouvelle catégorie</a>

            <div class="card">
                <div class="card-body">
                    @if($categories->count())
                        <table class="table">
                            <thead>
                                <tr><th>#</th><th>Nom</th><th>Actions</th></tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $categorie)
                                    <tr>
                                        <td>{{ $categorie->id }}</td>
                                        <td>{{ $categorie->nom }}</td>
                                        <td>
                                            <a href="{{ route('categories.edit', $categorie) }}" class="btn btn-sm btn-outline-secondary">Éditer</a>
                                            <form action="{{ route('categories.destroy', $categorie) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $categories->links() }}
                    @else
                        <p>Aucune catégorie trouvée.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>