<?php

namespace App\Policies\Content;

use App\Models\User;
use App\Models\Content\Hiring;
use App\Policies\Policy;


class HiringPolicy extends Policy
{
   

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function index(User $user, Hiring $hiring)
    {
        return $user->can('hiring_list');
    }

     public function create(User $user, Hiring $hiring)
    {
        // echo "string11";die;
        return $user->can('hiring_list');
    }

    public function store(User $user, Hiring $hiring)
    {
        return $user->can('hiring_list');
    }

    public function update(User $user, Hiring $hiring)
    {
        return $user->can('hiring_list');
    }

    public function edit(User $user, Hiring $hiring)
    {
        return $user->can('hiring_list');
    }
    public function destroy(User $user, Hiring $hiring)
    {
        return $user->can('hiring_list');
    }
    


}
