<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <title>Social Network - Register</title>
</head>
<body>
    <form class="form" method="POST" action="/register">
        @csrf
        <h1 class="form__title">Create Account</h1>
        <div class="form__group">
            <label class="form__label" for="username">Username</label>
            <input class="form__input" id="username" name="username" type="text" />    
        </div>
        <div class="form__group">
            <label class="form__label" for="email">Email</label>
            <input class="form__input" id="email" name="email" type="email" />    
        </div>
        <div class="form__group">
            <label class="form__label" for="password">Password</label>
            <input class="form__input" id="password" name="password" type="password" />    
        </div>
        <div class="form__group">
            <label class="form__label" for="confirmedPassword">Confirm Password</label>
            <input class="form__input" id="confirmedPassword" name="confirmedPassword" type="password" />    
        </div>
        <button class="form__button" type="submit">Create Account</button>
    </form>
</body>
</html>