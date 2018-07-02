<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
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

    // public function manage(User $user)
    // {
    //     return $user->hasPerm('permissions.manage');
    // }

    public function groups(User $user)
    {
        return $user->hasPerm('permissions.groups');
    }
}
