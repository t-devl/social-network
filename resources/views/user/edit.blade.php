@extends("layouts.app")

@section("content")

<form class="form" method="POST" action="/users/edit">
    @csrf
    <h1 class="form__title">Update your profile</h1>
    <div class="form__group">
        <label class="form__label" for="username">Username</label>
        <p class="form__requirement">Maximum 20 characters</p>
        <input class="form__input" id="username" name="username" type="text" value="{{ Auth::user()->username }}" required />    
        @error("username")
        <p class="form__error">{{ $message }}</p>
        @enderror
    </div>
    <div class="form__group">
        <label class="form__label" for="email">Email</label>
        <input class="form__input" id="email" name="email" type="email" value="{{ Auth::user()->email }}" required />    
        @error("email")
        <p class="form__error">{{ $message }}</p>
        @enderror
    </div>
    <div class="form__group">
        <label class="form__label" for="password" >Password</label>
        <p class="form__requirement">6 or more characters</p>
        <input class="form__input" id="password" name="password" type="password" required />    
        @error("password")
        <p class="form__error">{{ $message }}</p>
        @enderror
    </div>
    <div class="form__group">
        <label class="form__label" for="confirmedPassword">Confirm Password</label>
        <input class="form__input" id="confirmedPassword" name="confirmedPassword" type="password" required />
        @error("password_confirmation")
        <p class="form__error">{{ $message }}</p>
        @enderror    
    </div>
    <button class="form__button" type="submit">Update Profile</button>
</form>

@endsection