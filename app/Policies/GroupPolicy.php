<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Group;

class GroupPolicy
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
        return $user->hasPerm('groups.manage');
    }

    public function edit(User $user, Group $group)
    {
        return $this->manage($user) && $group->canEdit() && $group->belogsUser($user);
    }

    public function delete(User $user, Group $group)
    {
        return $this->manage($user) && $group->canDelete() && $group->belogsUser($user);
    }
}
