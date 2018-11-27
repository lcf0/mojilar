<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Content\About;


class AboutPolicy extends Policy
{
   

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function index(User $user, About $about)
    {
        return $user->can('manage_list');
    }

     public function create(User $user, About $about)
    {
        // echo "string11";die;
        return $user->can('manage_list');
    }

    public function store(User $user, About $about)
    {
        return $user->can('manage_list');
    }

    public function update(User $user, About $about)
    {
        return $user->can('manage_list');
    }

    public function edit(User $user, About $about)
    {
        return $user->can('manage_list');
    }
    public function destroy(User $user, About $about)
    {
        return $user->can('manage_list');
    }
    


}
