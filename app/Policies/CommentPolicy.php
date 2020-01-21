<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function reply(User $user, Comment $comment)
    {
        return !$comment->parent_id;
    }

    public function update(User $user, Comment $comment)
    {
        return $user->id == $comment->user_id;
    }
}
