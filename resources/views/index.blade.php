@extends("layouts.app")

@section("content")

@auth
<div class="feed">
    <h1 class="feed__title">My Feed</h1>
    <div class="feed__posts posts">
    @foreach($posts as $post)
        <x-post :post="$post" />
    @endforeach
    </div>
</div>
@endauth

@endsection