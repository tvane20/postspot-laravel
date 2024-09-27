<?php

namespace App\Policies;

use App\Models\User;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    use App\Models\Post;

public function publish(User $user)
{
    return $user->hasRole('Admin');
}

public function delete(User $user, Post $post)
{
    return $user->hasRole('Admin') || ($user->hasRole('Auteur') && $user->id === $post->user_id);
}

public function edit(User $user, Post $post)
{
    return $user->hasRole('Admin') || ($user->hasRole('Auteur') && $user->id === $post->user_id && $post->status === 'brouillon');
}
}
