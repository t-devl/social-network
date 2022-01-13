@extends("layouts.app")

@section("content")
<div class="profile">
    <div class="profile__top">
    <a class="profile__likes-link" href="/users/{{ $user->id }}/likes">Likes</a>
    <h1 class="profile__username">{{ $user->username }}</h1>
    @if(Auth::user() && Auth::user()->id === $user->id)
    <a class="profile__edit-link" href="/users/edit">Edit</a>
    @else
        @if(!$isFollowed)
        <form class="profile__follow" method="POST" action="/follow">
            @csrf
            <input  type="hidden" class="follow__id" value="{{ $user->id }}" name="followedId" />
            <button class="profile__follow-button" type="submit">Follow</button>
        </form>
        @else
        <form class="profile__follow" method="POST" action="/follow">
            @csrf
            @method("delete")
            <input type="hidden" class="follow__id" value="{{ $user->id }}" name="followedId" />
            <button class="profile__follow-button profile__follow-button--unfollow" type="submit">Unfollow</button>
        </form>
        @endif
    @endif
    </div>
 
    <div class="profile__follow-stats">
        <div class="profile__follow-stat profile__follow-stat--following">
            <a class="profile__follow-link" href="/users/{{ $user->id }}/following">Following: <span class="profile__follow-count">{{ $followingCount }}</span></a>
        </div>
        <div class="profile__follow-stat profile__follow-stat--followers">
            <a class="profile__follow-link" href="/users/{{ $user->id }}/followers">Followers: <span class="profile__follow-count">{{ $followersCount }}</span></a>
        </div>
      
    </div>
    <div class="profile__posts posts">
        <h2 class="posts__title">Posts</h2> 
        @foreach($posts as $post)
        <x-post :post="$post" />
        @endforeach
    </div>
</div>

@endsection


<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        $(".post__likes").on("submit", ".post__like", function(e){
            e.preventDefault();
            $form = $(e.target);
            $button = $form.find(".post__like-button");
            $button.attr("disabled", true);
            $formData = $form.serialize();
            $postId = $form.find(".post__id").val();
             if($form.find("[name='_method']").val()){
                $method = "delete";    
             }
             else{
                $method = "post";
             }

            $.ajax({
                url: `/likes/${$postId}`,
                type: "POST",
                data: $formData,
                success: function(res){
                    $button.attr("disabled", false);
                    $likesDisplay = $form.next();
                    $likesCount = parseInt($likesDisplay.find(".post__like-count").text());

                    if($method == "post"){
                        $button.addClass("post__like-button--unlike");
                        $button.html("Unlike");       
                        $likesDisplay.html(`
                        ${$likesCount == 0 ? `<span class="post__like-count">1</span> like`
                        : `<span class="post__like-count">${$likesCount + 1}</span> likes`}  
                        `);
                        $form.append("<input type='hidden' name='_method' value='delete' />");
                    }
                    else{
                        $button.removeClass("post__like-button--unlike");
                        $button.html("Like");
                        $likesDisplay.html(`
                        ${$likesCount == 2 ? `<span class="post__like-count">1</span> like`
                        : `<span class="post__like-count">${$likesCount - 1}</span> likes`}  
                        `);
                        $form.find("[name='_method']").remove();
                    }
                }
            });
        });

        $(".profile__follow").on("submit", function(e){
            e.preventDefault();
            $form = $(e.target);
            $button = $form.find(".profile__follow-button");
            $button.attr("disabled", true);
            $followId = $form.find(".follow__id").val();
            $formData = $form.serialize();

            if($form.find("[name='_method']").val()){
                $method = "delete";
            }
            else{
                $method = "post";
            }

            $.ajax({
                url: "/follow",
                type: "POST",
                data: $formData,
                success: function(res){
                    $button.attr("disabled", false);
                    $followers = $(document).find(".profile__follow-stat--followers");
                    $followerCount = $followers.find(".profile__follow-count");

                    if($method == "post"){
                        $button.addClass("profile__follow-button--unfollow");
                        $button.html("Unfollow");
                        $followerCount.html(parseInt($followerCount.text()) + 1);
                        $form.append("<input type='hidden' name='_method' value='delete' />");
                    }
                    else{
                        $button.removeClass("profile__follow-button--unfollow");
                        $button.html("Follow");
                        $followerCount.html(parseInt($followerCount.text()) - 1);
                        $form.find("[name='_method']").remove();
                    }
                }
            });
        });
    });
</script>