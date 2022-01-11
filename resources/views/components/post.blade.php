<div class="posts__post post">
    <header class="post__header">
        <h3 class="post__author"><a class="post__author-link" href="/users/{{ $post->user->id }}">{{ $post->user->username }}</a></h3>
        <div class="post__datetime">{{ $post->created_at->format("H:i d/m/Y") }}</div>
    </header>
    <p class="post__text">{{ $post->text }}</p>
    <div class="post__likes">
        @if(!Auth::user() || !in_array(Auth::user()->id, $post->likes))
        <form class="post__like" method="POST" action="/likes/{{ $post->id }}">
            @csrf
            <button class="post__like-button" type="submit">Like</button>
        </form>
        @else
        <form class="post__like" method="POST" action="/likes/{{ $post->id }}">
            @csrf
            @method("delete")
            <button class="post__like-button post__like-button--unlike" type="submit">Unlike</button>
        </form>
        @endif
        <span class="post__like-count">{{ count($post->likes) }} 
            @if(count($post->likes) == 1)
            like
            @else
            likes
            @endif
        </span>
    </div>
</div>