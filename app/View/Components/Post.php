<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class Post extends Component
{
    public $post;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $likes = $post->likes()->pluck("user_id")->toArray();
        $post->likes = $likes;
        $post->likedBy = User::whereIn("id", $likes)->get();
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post');
    }
}
