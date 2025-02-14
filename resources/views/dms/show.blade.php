<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dm</title>
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
    <a href="{{route('dms.index')}}">page d'accueil<a>
            <div>
                <h2>{{ $dm->title }}</h2>
                <p>Professeur: {{ $dm->professor->name }}</p>
                <p>Date d'expiration: {{ $dm->expire_at }}</p>
                @foreach ($dm->questions as $question)
                    <p>Question: {{$question->name}}</p>
                    <p>Choix: {{$question->choices}}</p>
                @endforeach
            </div>
            <Fieldset legend="modifier le dm">
                <form action="{{ route('dms.update', $dm->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <label for="title">Titre du dm</label>
                    <input type="text" name="title" id="title" value="{{ $dm->title }}" required>
                    @error('title')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <br>
                    <label for="description">Description du dm</label>
                    <textarea name="description" id="description" rows="4" required>{{ $dm->description }}</textarea>
                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <br>
                    <label for="expire_at">Date d'expiration</label>
                    <input type="datetime-local" name="expire_at" id="expire_at" value="{{ $dm->expire_at }}" required>
                    @error('expire_at')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <br>
                    <button type="submit">Modifier</button>
                </form>
            </Fieldset>
</body>

</html>