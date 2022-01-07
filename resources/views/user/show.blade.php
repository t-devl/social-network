@extends("layouts.app")

@section("content")
<div class="profile">
    <h1 class="profile__username">{{ $user->username }}</h1>
    @if(Auth::user()->id !== $user->id)
        @if(!$isFollowed)
        <form class="profile__follow" method="POST" action="/follow">
            @csrf
            <input type="hidden" value="{{ $user->id }}" name="followedId" />
            <button class="profile__follow-button" type="submit">Follow</button>
        </form>
        @else
        <form class="profile__follow" method="POST" action="/follow">
            @csrf
            @method("delete")
            <input type="hidden" value="{{ $user->id }}" name="followedId" />
            <button class="profile__follow-button profile__follow-button--unfollow" type="submit">Unfollow</button>
        </form>
        @endif
    @endif
    <div class="profile__follow-stats">
        <div class="profile__follow-stat">Following: <span class="profile__follow-number">{{ $followingCount }}</span></div>
        <div class="profile__follow-stat">Followers: <span class="profile__follow-number">{{ $followersCount }}</span></div>
    </div>
    <div class="profile__posts posts">
        <h2 class="posts__title">Posts</h2>
        @foreach($posts as $post)
        <div class="posts__post post">
            <header class="post__header">
                <h3 class="post__author">{{ $user->username }}</h3>
                <div class="post__datetime">{{ $post->created_at->format("d/m/Y H:i") }}</div>
            </header>
            <p class="post__text">{{ $post->text }}</p>
        </div>
        @endforeach
    </div>
</div>

@endsection