<div class="user">
    <div class="user__top">
        <div class="user__top-left">
            <img class="user__picture" src="{{ $user->profile_picture }}"/>
            <div class="user__details">
                <h2 class="user__username">{{ $user->username }}</h2>
                <a class="user__link" href="/users/{{ $user->id }}">View profile</a>
            </div>
        </div>
        @if(in_array($user->id, $followedUsers))
        <span class="user__followed-indicator">Followed</span>
        @endif
    </div>
</div>