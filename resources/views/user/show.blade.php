@extends("layouts.app")

@section("content")
<div class="profile">
    <div class="profile__top">
    @if($isOwnProfile)
    <div class="profile__picture profile__picture--editable">
        <img class="profile__image" src="{{$user->profile_picture}}"/>
        <div class="profile__image-text">Change picture</div>
    </div>
    <div class="profile__picture-modal-container">
        <div class="profile__picture-modal picture-modal">
            <h2 class="picture-modal__title">Change profile picture</h2>
            <img class="picture-modal__preview" src="{{$user->profile_picture}}"/>
            <form class="picture-modal__form" method="POST" action="/picture">
                @csrf
                <div class="picture-modal__options">
                    <label class="picture-modal__option" for="image1">
                        <input class="picture-modal__radio-button" value="/images/ginger-cat.jpg" type="radio" id="image1" name="image"/>
                        <img class="picture-modal__option-image" src="/images/ginger-cat.jpg" alt="ginger cat"/>
                    </label>
                    <label class="picture-modal__option" for="image2">
                        <input class="picture-modal__radio-button" value="/images/white-dog.jpg" type="radio" id="image2" name="image"/>
                        <img class="picture-modal__option-image" src="/images/white-dog.jpg" alt="small white dog"/>
                    </label>
                    <label class="picture-modal__option" for="image3">
                        <input class="picture-modal__radio-button" value="/images/castle-combe.jpg" type="radio" id="image3" name="image"/>
                        <img class="picture-modal__option-image" src="/images/castle-combe.jpg" alt="Castle Combe"/>
                    </label>
                    <label class="picture-modal__option" for="image4">
                        <input class="picture-modal__radio-button" value="/images/french-alps.jpg" type="radio" id="image4" name="image"/>
                        <img class="picture-modal__option-image" src="/images/french-alps.jpg" alt="snow in the French Alps"/>
                    </label>
                    <label class="picture-modal__option" for="image5">
                        <input class="picture-modal__radio-button" value="/images/portofino.jpg" type="radio" id="image5" name="image"/>
                        <img class="picture-modal__option-image" src="/images/portofino.jpg" alt="colourful houses on coast of Portofino"/>
                    </label>
                    <label class="picture-modal__option" for="image6">
                        <input class="picture-modal__radio-button" value="/images/versailles.jpg" type="radio" id="image6" name="image"/>
                        <img class="picture-modal__option-image" src="/images/versailles.jpg" alt="Versailles from outside"/>
                    </label>
                    <label class="picture-modal__option" for="image7">
                        <input class="picture-modal__radio-button" value="/images/versailles-window.jpg" type="radio" id="image7" name="image"/>
                        <img class="picture-modal__option-image" src="/images/versailles-window.jpg" alt="Window view from Versailles"/>
                    </label>
                    <label class="picture-modal__option" for="image8">
                        <input class="picture-modal__radio-button" value="/images/versailles-corridor.jpg" type="radio" id="image8" name="image"/>
                        <img class="picture-modal__option-image" src="/images/versailles-corridor.jpg" alt="corridor in Versailles"/>
                    </label>
                    <label class="picture-modal__option" for="image9">
                        <input class="picture-modal__radio-button" value="/images/london.jpg" type="radio" id="image9" name="image"/>
                        <img class="picture-modal__option-image" src="/images/london.jpg" alt="Big Ben and Houses of Parliament"/>
                    </label>
                    <label class="picture-modal__option" for="image10">
                        <input class="picture-modal__radio-button" value="/images/venice.jpg" type="radio" id="image10" name="image"/>
                        <img class="picture-modal__option-image" src="/images/venice.jpg" alt="Venice"/>
                    </label>
                    <label class="picture-modal__option" for="image11">
                        <input class="picture-modal__radio-button" value="/images/moscow.jpg" type="radio" id="image11" name="image"/>
                        <img class="picture-modal__option-image" src="/images/moscow.jpg" alt="St Basil's Cathedral, Moscow"/>
                    </label>
                    <label class="picture-modal__option" for="image12">
                        <input class="picture-modal__radio-button" value="/images/st-petersburg.jpg" type="radio" id="image12" name="image"/>
                        <img class="picture-modal__option-image" src="/images/st-petersburg.jpg" alt="Catherine Palace, St Petersburg"/>
                    </label>
                </div>
                <div class="picture-modal__buttons">
                    <button class="picture-modal__button picture-modal__button--save" type="submit">Save</button>
                    <button class="picture-modal__button picture-modal__button--cancel" type="button">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    @else
    <img class="profile__picture" src="{{$user->profile_picture}}"/>
    @endif
    <a class="profile__likes-link" href="/users/{{ $user->id }}/likes">Likes</a>
    <h1 class="profile__username">{{ $user->username }}</h1>
    @if($isOwnProfile)
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
            $("body").addClass("no-scroll");
        });

        $(".like-modal__button").on("click", function(){
            $(this).closest(".post__like-modal-container").removeClass("post__like-modal-container--active");
            $("body").removeClass("no-scroll");
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

        function closeModal(){
            $(".profile__picture-modal-container").removeClass("profile__picture-modal-container--active");
        }

        $(".picture-modal__form").on("submit", function(e){
            e.preventDefault();
            $form = $(e.target);
            $formData = $form.serialize();
            $.ajax({
                url: "/picture",
                type: "POST",
                data: $formData,
                success: function(res){
                    let formerImage = $(".profile__image");
                    let newImageSrc = $(".picture-modal__radio-button:checked").val();
                    if(newImageSrc != formerImage.attr("src")){
                        formerImage.attr("src", newImageSrc);
                    }
                    closeModal();
                }
            });
        });

        $(".profile__picture--editable").on("click", function(){
            $(".profile__picture-modal-container").addClass("profile__picture-modal-container--active");
        });

        $(".picture-modal__button--cancel").on("click", function(){
            closeModal();
        });
        
        $(".picture-modal__radio-button").on("change", function(){
            let preview = $(".picture-modal__preview");
            preview.attr("src", $(this).val());
        });
    });
</script>
@endsection