@extends("layouts.app")

@section("content")
    <div class="users">
    @foreach($users as $user)
        <div class="user">
            <h2 class="user__username">{{ $user->username }}</h2>
            <a class="user__link" href="/users/{{ $user->id }}">View profile</a>
        </div>
    @endforeach
    </div>
@endsection