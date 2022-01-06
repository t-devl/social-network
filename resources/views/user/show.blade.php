@extends("layouts.app")

@section("content")
<div class="profile">
    <h1 class="profile__username">{{ $user->username }}</h1>
    <div class="profile__posts posts">
        <h2 class="posts__title">Posts</h2>
        @foreach($posts as $post)
        <div class="posts__post post">
            <header class="post__header">
                <h3 class="post__author">{{ $user->username }}</h3>
                <div class="post__date">{{ $post->created_at->format("d/m/Y") }}</div>
            </header>
            <p class="post__text">{{ $post->text }}</p>
        </div>
        @endforeach
    </div>
</div>

@endsection