<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'group_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // protected $with = [
    //     'group'
    // ];

    /**Start relations */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    /**End relations */

    /**Start Mutators*/
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    /**End mutators */

    /**Start Helper*/
    public function hasPerm(...$perms)
    {
        foreach ($perms as $perm) {
            return $this->group->permissions->contains('name', $perm);
        }
    }

    public function getAllGroups()
    {
        return Group::descendantsAndSelf($this->group_id);
    }

    public function getTreeAllGroups()
    {
        return Group::descendantsAndSelf($this->group_id)->toTree();
    }
    /**End Helper*/
}
