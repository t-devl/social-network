@extends("layouts.app")

@section("content")

<form class="form" method="POST" action="/posts">
    @csrf
    <h1 class="form__title">Create a post</h1>
    <div class="form__group">
        <textarea class="form__input form__input--textarea" id="text" name="text" placeholder="What do you want to say?" required></textarea>
    </div>
    <input type="hidden" name="userId" value="{{ Auth::user()->id }}"/>
    <button class="form__button" type="submit">Create Post</button>
    @error("text")
    <p class="form__error">{{ $message }}</p>
    @enderror
</form>

@endsection