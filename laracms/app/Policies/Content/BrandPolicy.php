<?php

namespace App\Policies\Content;

use App\Models\User;
use App\Models\Content\Brand;
use App\Policies\Policy;


class BrandPolicy extends Policy
{
   

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function index(User $user, Brand $brand)
    {
        return $user->can('brand_list');
    }

     public function create(User $user, Brand $brand)
    {
        // echo "string11";die;
        return $user->can('brand_list');
    }

    public function store(User $user, Brand $brand)
    {
        return $user->can('brand_list');
    }

    public function update(User $user, Brand $brand)
    {
        return $user->can('brand_list');
    }

    public function edit(User $user, Brand $brand)
    {
        return $user->can('brand_list');
    }
    public function destroy(User $user, Brand $brand)
    {
        return $user->can('brand_list');
    }
    


}
