<?php

namespace App\View\Components;

use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class User extends Component
{
    public $user;
    public $followedUsers;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user)
    {   
        $this->user = $user;
        $this->followedUsers = Auth::user() ? ModelsUser::find(Auth::user()->id)->following()->pluck("followed_id")->toArray() :  [];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user');
    }
}
