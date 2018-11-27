<?php

namespace App\Policies\Content;

use App\Models\User;
use App\Models\Content\Protocol;
use App\Policies\Policy;


class ProtocolPolicy extends Policy
{
   

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function index(User $user, Protocol $protocol)
    {
        return $user->can('protocol_list');
    }

     public function create(User $user, Protocol $protocol)
    {
        // echo "string11";die;
        return $user->can('protocol_list');
    }

    public function store(User $user, Protocol $protocol)
    {
        return $user->can('protocol_list');
    }

    public function update(User $user, Protocol $protocol)
    {
        return $user->can('protocol_list');
    }

    public function edit(User $user, Protocol $protocol)
    {
        return $user->can('protocol_list');
    }
    public function destroy(User $user, Protocol $protocol)
    {
        return $user->can('protocol_list');
    }
    


}
