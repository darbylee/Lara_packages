<?php
namespace Pdusan\SimpleBlog\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\User;
use Pdusan\SimpleBlog\Models\SBlogPost;

class SBlogPostPolicy
{
    use HandlesAuthorization;

    public function canCreateComment(User $user, SBlogPost $post)
    {
        return  $user->id !== $post->user_id && !$post->comments()->where('user_id', '=', $user->id)->exists();
    }

    public function delete(User $user, SBlogPost $post)
    {
        return $user->id === $post->user_id;
    }

    public function update(User $user, SBlogPost $post)
    {
        return $user->id === $post->user_id;
    }
}