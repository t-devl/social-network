@extends("layouts.app")

@section("content")

<div class="following">
<h1 class="following__title">Followed by {{ $user->username }}</h1>
    <div class="following__users users">
        @if(count($followedUsers) == 0)
        <p class="users__message">This user is not following anyone.</p>
        @else
        @foreach($followedUsers as $followedUser)
        <x-user :user="$followedUser" />
        @endforeach
        @endif
    </div>
</div>
@endsection