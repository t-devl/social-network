@extends("layouts.app")

@section("content")

<div class="following">
<h1 class="following__title">Followers</h1>
    <div class="following__users users">
        @foreach($users as $user)
            <div class="user">
                <div class="user__top">
                    <h2 class="user__username">{{ $user->username }}</h2>
                    @if(in_array($user->id, $followedUsers))
                    <span class="user__followed-indicator">Followed</span>
                    @endif
                </div>
                <a class="user__link" href="/users/{{ $user->id }}">View profile</a>
            </div>
        @endforeach
    </div>
</div>
@endsection