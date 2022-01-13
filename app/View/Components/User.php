<?php

namespace App\View\Components;

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
    public function __construct($user, $followedUsers)
    {
        $this->user = $user;
        $this->followedUsers = $followedUsers;
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
