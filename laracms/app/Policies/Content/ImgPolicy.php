<?php

namespace App\Policies\Content;

use App\Models\User;
use App\Models\Content\Img;
use App\Policies\Policy;


class ImgPolicy extends Policy
{
   

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function index(User $user, Img $img)
    {
        return $user->can('img_list');
    }

     public function create(User $user, Img $img)
    {
        // echo "string11";die;
        return $user->can('img_list');
    }

    public function store(User $user, Img $img)
    {
        return $user->can('img_list');
    }

    public function update(User $user, Img $img)
    {
        return $user->can('img_list');
    }

    public function edit(User $user, Img $img)
    {
        return $user->can('img_list');
    }
    public function destroy(User $user, Img $img)
    {
        return $user->can('img_list');
    }
    


}