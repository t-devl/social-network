@extends("layouts.app")

@section("content")

<div class="following">
<h1 class="following__title">{{ $user->username}}'s Followers</h1>
    <div class="following__users users">
        @if(count($followers) == 0)
        <p class="users__message">This user has no followers.</p>
        @else
        @foreach($followers as $follower)
        <x-user :user="$follower" />
        @endforeach
        @endif
    </div>
</div>
@endsection