<?php

namespace App\Policies\Content;

use App\Models\User;
use App\Models\Content\Info;
use App\Policies\Policy;


class InfoPolicy extends Policy
{
   

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function index(User $user, Info $info)
    {
        return $user->can('info_list');
    }

     public function create(User $user, Info $info)
    {
        // echo "string11";die;
        return $user->can('info_list');
    }

    public function store(User $user, Info $info)
    {
        return $user->can('info_list');
    }

    public function update(User $user, Info $info)
    {
        return $user->can('info_list');
    }

    public function edit(User $user, Info $info)
    {
        return $user->can('info_list');
    }
    public function destroy(User $user, Info $info)
    {
        return $user->can('info_list');
    }
    


}