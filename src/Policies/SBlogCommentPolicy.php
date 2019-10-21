<?php
namespace Pdusan\SimpleBlog\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\User;

use Pdusan\SimpleBlog\Models\SBlogPost;
use Pdusan\SimpleBlog\Models\SBlogComment;

class SBlogCommentPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, SBlogComment $comment)
    {
        return $user->id === $comment->user_id;
    }

    public function update(User $user, SBlogComment $comment)
    {
        return $user->id === $comment->user_id;
    }
}