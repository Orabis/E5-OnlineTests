<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un DM</title>
</head>

<body>
    <h1>Créer un Devoir Maison</h1>
    <a href="{{route('dms.index')}}">Retour<a>

            <form method="POST" action="{{ route('dms.store') }}">
                @csrf
                <label for="title">Titre du DM</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="error">{{ $message }}</div>
                @enderror

                <br>
                <label for="description">Description du DM</label>
                <textarea name="description" id="description" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror

                <br>
                <label for="expire_at">Date d'expiration</label>
                <input type="datetime-local" name="expire_at" id="expire_at" value="{{ old('expire_at') }}" required>
                @error('expire_at')
                    <div class="error">{{ $message }}</div>
                @enderror

                <br>
                <button type="submit">Créer le DM</button>
            </form>
</body>

</html>