<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creation d'annonce</title>
    <link rel="stylesheet" href="/Bootstrap_5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    @if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif
    <form action="{{route('store')}}" method="POST" class="form-group ">
        @csrf

        <!--Container principal du formulaire -->
        <h1 class="text-center text-primary">Créer une annonce </h1>
        <div class="container d-flex flex-column justify-content-center align-items center mb-5 card p-4  gap-3" style="max-width:60%">
            
            <!--Titre -->
            <div>
                <label for="titre">Titre</label>
                <input type="text" name="titre" class="form-control" >
            </div>

            <!--Contenu -->
            <div>
                <label for="contenu">Contenu</label>
                <textarea name="contenu" id="contenu" cols="30" rows="10" class="form-control"></textarea>
            </div>

            <!--Categorie -->
            <div>
                <label for="Categorie">Categorie</label>
                <select name="categorie_id" id=""  class="form-control">
                    <option value="">--Sélectionnez une categorie--</option>
                    @foreach ($categories as $categorie)
                        <option value="{{$categorie->id}}">{{$categorie->nom}}</option>
                    @endforeach
                </select>

            </div>


            <!--Date de l'evenement -->
            <div>
                <label for="date_evenement">Date de l'évenement:</label>
                <input type="date" name="date_evenement" class="form-control" >
            </div>


            <!--Salle concernée -->
            <div>
                <label for="Categorie">Sélectionnez une salle si concernée :</label>
                <select name="categorie_id" id=""  class="form-control">
                    <option value="">--Sélectionnez une salle--</option>
                    @foreach ($categories as $categorie)
                        <option value="{{$categorie->id}}">{{$categorie->nom}}</option>
                    @endforeach
                </select>

            </div>


            <!--Equipements concernés -->
            <div>
                <label for="Categorie">Sélectionnez les equipments concernés:</label>
                <select name="categorie_id" id=""  class="form-control">
                    <option value="">--Sélectionnez les equipements--</option>
                    @foreach ($categories as $categorie)
                        <option value="{{$categorie->id}}">{{$categorie->nom}}</option>
                    @endforeach
                </select>

            </div>

            <!--Bouton valider -->
            <div class="">
                <input type="submit" name="submit" class="form-control btn btn-outline-primary" value="Publier" >
            </div>
        </div>
    </form>
</body>
</html>