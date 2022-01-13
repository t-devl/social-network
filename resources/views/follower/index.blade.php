@extends("layouts.app")

@section("content")

<div class="following">
<h1 class="following__title">Followers</h1>
    <div class="following__users users">
        @foreach($users as $user)
            <x-user :user="$user" :followedUsers="$followedUsers" />
        @endforeach
    </div>
</div>
@endsection