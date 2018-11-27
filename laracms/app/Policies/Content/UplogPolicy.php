<?php

namespace App\Policies\Content;

use App\Models\User;
use App\Models\Content\Uplog;
use App\Policies\Policy;


class UplogPolicy extends Policy
{
   

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function index(User $user, Uplog $uplog)
    {
        return $user->can('uplog_list');
    }

     public function create(User $user, Uplog $uplog)
    {
        // echo "string11";die;
        return $user->can('uplog_list');
    }

    public function store(User $user, Uplog $uplog)
    {
        return $user->can('uplog_list');
    }

    public function update(User $user, Uplog $uplog)
    {
        return $user->can('uplog_list');
    }

    public function edit(User $user, Uplog $uplog)
    {
        return $user->can('uplog_list');
    }
    public function destroy(User $user, Uplog $uplog)
    {
        return $user->can('uplog_list');
    }
    


}