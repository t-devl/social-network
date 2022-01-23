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
        @if(count($posts) == 0)
        <p class="posts__message">This user has no posts.</p>
        @else
        @foreach($posts as $post)
        <x-post :post="$post" />
        @endforeach
        @endif
    </div>
</div>

<script>
    $(document).ready(function(){
        $(".post__like").on("submit", function(e){
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
                statusCode:{
                    401: function(){
                        window.location.href = "/login";
                    }
                },
                success: function(res){
                    $button.attr("disabled", false);
                    $likesDisplay = $form.next();
                    $likesCount = parseInt($likesDisplay.find(".post__like-count").text());
                    
                    $modalContainer = $form.siblings(".post__like-modal-container");
                    $username = $form.find(".post__liked-by-username").val();
                    $users = $modalContainer.find(".like-modal__users");
                    
                    if($method == "post"){
                        $button.addClass("post__like-button--unlike");
                        $button.html("Unlike");       
                        $form.append("<input type='hidden' name='_method' value='delete' />");

                        if($likesCount == 0){
                            $likesDisplay.html(`<span class="post__like-count">1</span> like`);

                            $users.html(`
                            <div class="user">
                                <div class="user__top">
                                    <h2 class="user__username">${$username}</h2>
                                </div>
                            </div>
                            `);
                        }
                        else{
                            $likesDisplay.html(`<span class="post__like-count">${$likesCount + 1}</span> likes`);

                            $users.append(`
                            <div class="user">
                                <div class="user__top">
                                    <h2 class="user__username">${$username}</h2>
                                </div>
                            </div>
                            `);
                        }
                    }
                    else{
                        $button.removeClass("post__like-button--unlike");
                        $button.html("Like");
                        $likesDisplay.html(`
                        ${$likesCount == 2 ? `<span class="post__like-count">1</span> like`
                        : `<span class="post__like-count">${$likesCount - 1}</span> likes`}  
                        `);
                        $form.find("[name='_method']").remove();

                        if($likesCount == 1){
                            $users.html("<p class='like-modal__message'>This post has no likes.</p>");
                        }
                        else{
                            $users.find(`.user__username:contains(${$username})`).closest(".user").remove();
                        }
                    }
                }
            });
        });

        $(".post__view-likes-button").on("click", function(e){
            $button = $(this);
            $button.next().addClass("post__like-modal-container--active");
        });

        $(".like-modal__button").on("click", function(){
            $(this).closest(".post__like-modal-container").removeClass("post__like-modal-container--active");
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
                statusCode:{
                    401: function(){
                        window.location.href = "/login";
                    }
                },
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
@endsection