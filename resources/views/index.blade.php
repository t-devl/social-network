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

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

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
    });
</script>