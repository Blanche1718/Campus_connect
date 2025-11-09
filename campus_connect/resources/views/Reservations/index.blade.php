

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reservations</title>
    <link rel="stylesheet" href="/Bootstrap_5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    
    <div class="container">
        <h2 class="mb-4 text-center">📅 Liste des Réservations</h2>
    
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif
    
        @if($reservations->isEmpty())
            <div class="alert alert-info text-center">
                Aucune réservation pour le moment.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Utilisateur</th>
                        <th>Salle</th>
                        <th>Équipement</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Statut</th>
                        <th>Motif</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $reservation->user->name ?? 'Utilisateur inconnu' }}</td>
                            <td>{{ $reservation->salle->nom ?? 'Non spécifié' }}</td>
                            <td>{{ $reservation->equipement->nom ?? 'Aucun' }}</td>
                            <td>{{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}</td>
                            <td>
                                @if($reservation->statut === 'en_attente')
                                    <span class="badge bg-warning text-dark">En attente</span>
                                @elseif($reservation->statut === 'valide')
                                    <span class="badge bg-success">Validée</span>
                                @else
                                    <span class="badge bg-danger">Rejetée</span>
                                @endif
                            </td>
                            <td>{{ $reservation->motif ?? '-' }}</td>
                            <td>
                                {{-- Tu pourras plus tard ajouter ici les boutons pour valider ou rejeter --}}
                                @if ($reservation->statut == 'en_attente')
                                    <div class="d-flex flex-row gap-2">
                                        <form action="{{route('valider_reservation' , $reservation->id)}}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="submit" class="btn btn-sm btn-info">Valider</button>
                                    </form>

                                    <form action="{{route('rejeter_reservation' , $reservation->id)}}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="submit" class="btn btn-sm btn-warning">Rejeter</button>
                                    </form>

                                    <form action="{{route('supprimer_reservation' , $reservation->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                    </form>
                                    </div>
                                @elseif ($reservation->statut == 'valide')
                                    <div class="d-flex flex-row gap-2">

                                    <form action="{{route('rejeter_reservation' , $reservation->id)}}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="submit" class="btn btn-sm btn-warning">Rejeter</button>
                                    </form>

                                    <form action="{{route('supprimer_reservation' , $reservation->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                    </form>
                                @else 
                                        <form action="{{route('supprimer_reservation' , $reservation->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                    </form>
                                @endif
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
