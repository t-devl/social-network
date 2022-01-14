@extends("layouts.app")

@section("content")
    <div class="users">
    @foreach($users as $user)
        <x-user :user="$user" />
    @endforeach
    </div>
@endsection