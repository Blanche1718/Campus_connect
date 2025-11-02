<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anonces</title>
    <link rel="stylesheet" href="/Bootstrap_5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <div class="container d-flex flex-row gap-3">
        @foreach ($annonces as $annonce)
            <div class="container">
                <p>
                    Publiée le {{$annonce->created_at}}
                </p>
                <p>
                    Titre: {{$annonce->titre}}
                </p>
                <p>
                    {{$annonce->contenu}}
                </p>
            </div>
        @endforeach
    </div>
</body>
</html>