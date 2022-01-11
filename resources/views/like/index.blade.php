@extends("layouts.app")

@section("content")

<div class="likes">
    <h1 class="likes__title">{{ $user->username }}'s Likes</h1>
        <div class="likes__posts posts">
            @foreach($posts as $post)
            <x-post :post="$post" />
            @endforeach
        </div>
    </div>
@endsection