@extends("layouts.app")

@section("content")

@auth
<div class="feed">
    <h2 class="feed__title">My Feed</h2>
    <div class="feed__posts posts">
    @foreach($posts as $post)
        <div class="posts__post post">
            <header class="post__header">
                <h3 class="post__author">{{ $post->user->username }}</h3>
                <div class="post__datetime">{{ $post->created_at->format("H:i d/m/Y") }}</div>
            </header>
            <p class="post__text">{{ $post->text }}</p>
        </div>
    @endforeach
    </div>
</div>
@endauth

@endsection