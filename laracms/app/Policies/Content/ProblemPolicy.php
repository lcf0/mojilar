<?php

namespace App\Policies\Content;

use App\Models\User;
use App\Models\Content\Problem;
use App\Policies\Policy;


class ProblemPolicy extends Policy
{
   

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function index(User $user, Problem $problem)
    {
        return $user->can('problem_list');
    }

     public function create(User $user, Problem $problem)
    {
        // echo "string11";die;
        return $user->can('problem_list');
    }

    public function store(User $user, Problem $problem)
    {
        return $user->can('problem_list');
    }

    public function update(User $user, Problem $problem)
    {
        return $user->can('problem_list');
    }

    public function edit(User $user, Problem $problem)
    {
        return $user->can('problem_list');
    }
    public function destroy(User $user, Problem $problem)
    {
        return $user->can('problem_list');
    }
    


}
