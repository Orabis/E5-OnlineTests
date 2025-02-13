<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des DM</title>
</head>

<body>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    <h1>Liste des Devoirs Maisons</h1>
    <a href="{{route('dashboard')}}">page d'accueil<a>
            <a href="{{route('dms.create')}}">Crée un devoir<a>
                    @foreach ($dms as $dm)
                        <div>
                            <h2>{{ $dm->title }}</h2>
                            <p>Professeur: {{ $dm->professor->name }}</p>
                            <p>Date d'expiration: {{ $dm->expire_at }}</p>
                            @foreach ($dm->questions as $question)
                                <p>Question: {{$question->name}}</p>
                                <p>Choix: {{$question->choices}}</p>
                            @endforeach
                            <form method="POST" action="{{ route('dms.destroy', $dm->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Supprimer</button>
                            </form>
                        </div>
                    @endforeach

</body>

</html>