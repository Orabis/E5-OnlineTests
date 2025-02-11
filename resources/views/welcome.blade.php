<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div>
        <div>
            <h1>Bienvenue sur Online Tests</h1>
            <p>Site de Contrôle en ligne pour les professeurs et leurs elèves !</p>
        </div>
        <a href="{{route('login')}}">Se connecter</a>
        <a href="#">Rentrer un lien</a>

    </div>
</body>

</html>