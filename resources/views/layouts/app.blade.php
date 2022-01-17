<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
    <title>Social Network</title>
</head>
<body>
    <header class="header">
        <nav class="header__nav nav">
            <button class="nav__toggle-button">
                <div class="nav__toggle-icon"></div>
            </button>
            <ul class="nav__list">
                @guest
                <li class="nav__item">
                    <a class="nav__link" href="/users">View Users</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="/login">Log in</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="/register">Register</a>
                </li>
                @endguest
                @auth
                <li class="nav__item nav__item--left">
                    <a class="nav__link" href="/">Home</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link nav__link--user" href="/users/{{ Auth::user()->id }}">{{ Auth::user()->username }}</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="/posts/create">Create a Post</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="/users">View Users</a>
                </li>
                <li class="nav__item">
                    <form class="nav__logout logout" method="POST" action="/logout">
                    @csrf
                        <button class="logout__button" type="submit">Log out</button>
                    </form>
                </li>
                @endauth     
            </ul>
        </nav>
    </header>
    <div class="wrapper">
    @yield("content")
    </div>
    <script>
        $(document).ready(function(){
            $(".nav__toggle-button").on("click", function(){
                $(".nav__list").toggleClass("nav__list--active");
            });
        });
    </script>
</body>
</html>



