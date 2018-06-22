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
    public function __construct(User $user)
    {

    }

    // public function before(User $user, $ability)
    // {
    //     // \Log::info('user.'.$ability);
    //     // return $user->checkPerms('user.'.$ability);
    // }

    public function index(User $user)
    {
        // dd($user);
        return true;
    }

    public function editTest(User $user)
    {
        // dd('editTest');
        return true;
    }
}
