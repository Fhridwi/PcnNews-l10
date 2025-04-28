<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Menentukan apakah user dapat melihat artikel.
     */
    public function view(User $user, Article $article)
    {
        // Semua user bisa melihat artikel
        return true;
    }

    /**
     * Menentukan apakah user dapat membuat artikel.
     */
    public function create(User $user)
    {
        // Hanya admin dan editor yang bisa membuat artikel
        return in_array($user->role, ['admin', 'editor']);
    }

    /**
     * Menentukan apakah user dapat mengupdate artikel.
     */
    public function update(User $user, Article $article)
    {
        // Hanya admin dan editor yang bisa mengupdate artikel,
        // atau author yang membuat artikel tersebut.
        return in_array($user->role, ['admin', 'editor']) || $user->id === $article->author_id;
    }

    /**
     * Menentukan apakah user dapat menghapus artikel.
     */
    public function delete(User $user, Article $article)
    {
        // Hanya admin yang bisa menghapus artikel
        return $user->role === 'admin';
    }
}
