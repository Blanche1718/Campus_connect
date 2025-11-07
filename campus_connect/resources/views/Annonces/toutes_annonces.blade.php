<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Détails de l'Annonce</title>
    
    <link rel="stylesheet" href="/Bootstrap_5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #6c75f5; 
            --soft-blue: #dee2ff;
            --soft-lavender: #f0e6ff;
            --text-color: #343a40;
            --card-bg: #ffffff;
            --shadow-strong: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        body {
            background: linear-gradient(135deg, var(--soft-blue), var(--soft-lavender));
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 0;
        }

        .ad-card {
            max-width: 800px;
            width: 90%;
            background-color: var(--card-bg);
            border-radius: 20px;
            box-shadow: var(--shadow-strong);
            border-left: 8px solid var(--primary-color); 
        }
        
        .ad-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 0.5rem;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .ad-meta-info span {
            font-size: 0.95rem;
            color: #6c757d;
            font-weight: 500;
        }

        .ad-content {
            white-space: pre-wrap; 
            line-height: 1.6;
        }
    </style>
</head>
<body> 
   

    <div class="d-flex flex-column gap-3">
        @if(count($annonces) == 0) 
            <div class="text-center">
                <h2 style="font-family:cursive">
                    Aucune annonce n'a été publiée pour le moment
                </h2>
            </div>
        
        @else
        @foreach ($annonces as $annonce)
            
    
        <div class="ad-card p-4 p-md-5">

            <h1 class="ad-title">{{$annonce->titre}}</h1>
            
            <div class="ad-meta-info mb-4 d-flex flex-wrap gap-4">
                <span>
                    <i class="bi bi-calendar-check text-success me-2"></i>
                    <strong>Publiée le</strong> &nbsp; <span class="text-danger">{{$annonce->updated_at->format('d/m/Y')}}</span> à  <span class="text-danger">{{$annonce->updated_at->format('H:i')}}</span>
                </span>
                
                <span>
                    <i class="bi bi-person-circle text-primary me-2"></i>
                    <strong style="color:green">Auteur</strong> : {{$annonce->auteur->name}}
                </span>
            </div>

            <hr class="my-3">

            <div class="ad-content">
                <p class="text-center">
                    {{Str::limit($annonce->contenu , 200)}} <br>
                    <div class="justify-content-end"><a href="{{route('annonce_particuliere' , $annonce->id)}}" class="btn btn-light justify-content-end">Lire la  suite...</a></div>
                </p>
                <hr>
            </div>
        
        </div>
        @endforeach
    @endif
    </div>
</body>
</html>