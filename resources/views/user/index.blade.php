@extends("layouts.app")

@section("content")
    <div class="users">
    @foreach($users as $user)
        <x-user :user="$user" :followedUsers="$followedUsers" />
    @endforeach
    </div>
@endsection