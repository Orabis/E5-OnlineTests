<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <a href="{{route('homepage')}}">Retour<a>
                <div class="form-container">
                    <h2>Login</h2>
                    <form action="{{ route('login.submit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                            @if ($errors->has('email'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            @if ($errors->has('password'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
                <div class="form-container">
                    <h2>create</h2>
                    <form action="{{ route('register.submit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="register-name">Name :</label>
                            <input type="register-name" id="register-name" name="register-name" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="register-email">Email:</label>
                            <input type="register-email" id="register-email" name="register-email" class="form-control"
                                required>
                            @if ($errors->has('register-email'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('register-email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="register-password">Password:</label>
                            <input type="register-password" id="register-password" name="register-password"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="register-password_confirmation">Confirm Password:</label>
                            <input type="password" id="register-password_confirmation"
                                name="register-password_confirmation" class="form-control" required>
                            @if ($errors->has('register-password'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('register-password') }}
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
    </div>
</body>

</html>