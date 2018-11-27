<?php

namespace App\Policies\Content;

use App\Models\User;
use App\Models\Content\Bcontact;
use App\Policies\Policy;


class BcontactPolicy extends Policy
{
   

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function index(User $user, Bcontact $bcontact)
    {
        return $user->can('busine_contact');
    }

     public function create(User $user, Bcontact $bcontact)
    {
        // echo "string11";die;
        return $user->can('busine_contact');
    }

    public function store(User $user, Bcontact $bcontact)
    {
        return $user->can('busine_contact');
    }

    public function update(User $user, Bcontact $bcontact)
    {
        return $user->can('busine_contact');
    }

    public function edit(User $user, Bcontact $bcontact)
    {
        return $user->can('busine_contact');
    }
    public function destroy(User $user, Bcontact $bcontact)
    {
        return $user->can('busine_contact');
    }
    


}
