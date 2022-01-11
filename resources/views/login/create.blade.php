<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <title>Social Network - Login</title>
</head>
<body>
    <form class="form" method="POST" action="/login">
        @csrf
        <h1 class="form__title">Log In</h1>
        <div class="form__group">
            <label class="form__label" for="uid">Username or Email</label>
            <input class="form__input" id="uid" name="uid" type="text" value="{{ old("uid") }}" required />
            @error("uid")
            <p class="form__error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form__group">
            <label class="form__label" for="password">Password</label>
            <input class="form__input" id="password" name="password" type="password" required/>
            @error("password")
            <p class="form__error">{{ $message }}</p>
            @enderror
        </div>
        <button class="form__button" type="submit">Log In</button>
        <p class="form__text">Not registered? <a class="form__link" href="/register">Create an account</a></p>
        <p class="form__text"><a class="form__link" href="/users">Have a look around first</a></p>
    </form>
</body>
</html>