<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function assignAdmin(User $user)
    {
        return $user->isSuperuser();
    }

    public function verifyUser(User $user)
    {
        return $user->isAdmin() || $user->isSuperuser();
    }

    public function suspendUser(User $user1, User $user2){
        if($user2->isAdmin() || $user2->isSuperuser()) return false;
        return $user1->isAdmin() || $user1->isSuperuser();
    }
}
