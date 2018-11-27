<?php

namespace App\Policies\Content;

use App\Models\User;
use App\Models\Content\Video;
use App\Policies\Policy;


class VideoPolicy extends Policy
{
   

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function index(User $user, Video $video)
    {
        return $user->can('video_list');
    }

     public function create(User $user, Video $video)
    {
        // echo "string11";die;
        return $user->can('video_list');
    }

    public function store(User $user, Video $video)
    {
        return $user->can('video_list');
    }

    public function update(User $user, Video $video)
    {
        return $user->can('video_list');
    }

    public function edit(User $user, Video $video)
    {
        return $user->can('video_list');
    }
    public function destroy(User $user, Video $video)
    {
        return $user->can('video_list');
    }
    


}