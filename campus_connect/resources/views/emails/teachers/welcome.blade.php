<x-mail::message>
# Bienvenue sur CampusConnect, {{ $user->name }} !

Un compte a été créé pour vous sur notre plateforme. Vous pouvez désormais vous connecter pour gérer vos annonces et réservations.

Voici vos identifiants de connexion temporaires :

**Email :** {{ $user->email }}
**Mot de passe :** {{ $temporaryPassword }}

Pour des raisons de sécurité, il vous sera demandé de changer ce mot de passe lors de votre première connexion.

<x-mail::button :url="$url">
Se connecter
</x-mail::button>

Merci,<br>
L'équipe {{ config('app.name') }}
</x-mail::message>
