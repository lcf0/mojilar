<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Content\Road;


class RoadPolicy extends Policy
{
   

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function index(User $user, Road $road)
    {
        return $user->can('manage_list');
    }

     public function create(User $user, Road $road)
    {
        // echo "string11";die;
        return $user->can('manage_list');
    }

    public function store(User $user, Road $road)
    {
        return $user->can('manage_list');
    }

    public function update(User $user, Road $road)
    {
        return $user->can('manage_list');
    }

    public function edit(User $user, Road $road)
    {
        return $user->can('manage_list');
    }
    public function destroy(User $user, Road $road)
    {
        return $user->can('manage_list');
    }
    


}
