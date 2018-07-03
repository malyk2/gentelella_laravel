<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Role;

class RolePolicy
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

    public function manage(User $user)
    {
        return $user->hasPerm('roles.manage');
    }

    public function edit(User $user, Role $role)
    {
        return $this->manage($user) && $role->canEdit() && $role->belogsUser($user);
    }
}
