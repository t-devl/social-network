@extends("layouts.app")

@section("content")
<div class="profile">
    <div class="profile__top">
    <a class="profile__likes-link" href="/users/{{ $user->id }}/likes">Likes</a>
    <h1 class="profile__username">{{ $user->username }}</h1>
    @if(Auth::user() && Auth::user()->id !== $user->id)
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
    </div>
 
    <div class="profile__follow-stats">
        <div class="profile__follow-stat">
            <a class="profile__follow-link" href="/users/{{ $user->id }}/following">Following: <span class="profile__follow-number">{{ $followingCount }}</span></a>
        </div>
        <div class="profile__follow-stat">
            <a class="profile__follow-link" href="/users/{{ $user->id }}/followers">Followers: <span class="profile__follow-number">{{ $followersCount }}</span></a>
        </div>
      
    </div>
    <div class="profile__posts posts">
        <h2 class="posts__title">Posts</h2> 
        @foreach($posts as $post)
        <x-post :post="$post" />
        @endforeach
    </div>
</div>

@endsection