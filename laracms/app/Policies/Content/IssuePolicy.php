<?php

namespace App\Policies\Content;

use App\Models\User;
use App\Models\Content\Issue;
use App\Policies\Policy;


class IssuePolicy extends Policy
{
   

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function index(User $user, Issue $issue)
    {
        return $user->can('issue_list');
    }

     public function create(User $user, Issue $issue)
    {
        // echo "string11";die;
        return $user->can('issue_list');
    }

    public function store(User $user, Issue $issue)
    {
        return $user->can('issue_list');
    }

    public function update(User $user, Issue $issue)
    {
        return $user->can('issue_list');
    }

    public function edit(User $user, Issue $issue)
    {
        return $user->can('issue_list');
    }
    public function destroy(User $user, Issue $issue)
    {
        return $user->can('issue_list');
    }
    


}
