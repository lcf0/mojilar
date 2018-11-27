<?php

namespace App\Policies\Content;

use App\Models\User;
use App\Models\Content\Dynamic;
use App\Policies\Policy;


class DynamicPolicy extends Policy
{
   

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function index(User $user, Dynamic $dynamic)
    {
        return $user->can('dynamic_list');
    }

     public function create(User $user, Dynamic $dynamic)
    {
        // echo "string11";die;
        return $user->can('dynamic_list');
    }

    public function store(User $user, Dynamic $dynamic)
    {
        return $user->can('dynamic_list');
    }

    public function update(User $user, Dynamic $dynamic)
    {
        return $user->can('dynamic_list');
    }

    public function edit(User $user, Dynamic $dynamic)
    {
        return $user->can('dynamic_list');
    }
    public function destroy(User $user, Dynamic $dynamic)
    {
        return $user->can('dynamic_list');
    }
    


}
