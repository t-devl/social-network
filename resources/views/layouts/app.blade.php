<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <title>Social Network</title>
</head>
<body>
    <header class="header">
        <h1 class="header__title">Social Network</h1>
        <nav class="header__nav nav">
            <ul class="nav__list">
                <li class="nav__item">
                    @guest
                    <a class="nav__link" href="/login">Log in</a>
                    <a class="nav__link" href="/register">Register</a>
                    @endguest
                    @auth
                    <form class="nav__logout logout" method="POST" action="/logout">
                        @csrf
                        <button class="logout__button" type="submit">Log out</button>
                    </form>
                    @endauth
                </li>
            </ul>
        </nav>
    </header>
    @yield("content")
</body>
</html>