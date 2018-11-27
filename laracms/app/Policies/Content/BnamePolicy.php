<?php

namespace App\Policies\Content;

use App\Models\User;
use App\Models\Content\Bname;
use App\Policies\Policy;


class BnamePolicy extends Policy
{
   

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function index(User $user, Bname $bname)
    {
        return $user->can('busine_name');
    }

     public function create(User $user, Bname $bname)
    {
        // echo "string11";die;
        return $user->can('busine_name');
    }

    public function store(User $user, Bname $bname)
    {
        return $user->can('busine_name');
    }

    public function update(User $user, Bname $bname)
    {
        return $user->can('busine_name');
    }

    public function edit(User $user, Bname $bname)
    {
        return $user->can('busine_name');
    }
    public function destroy(User $user, Bname $bname)
    {
        return $user->can('busine_name');
    }
    


}
