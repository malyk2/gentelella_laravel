<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

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

    /**Start relations */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    /**End relations */

    /**Start Mutators*/
    public function setPasswordAttribute($value)
    {
        ! empty($value) ? $this->attributes['password'] = bcrypt($value) : false;
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

    public function canEdit()
    {
        return $this->name !== 'admin';
    }

    public function canDelete()
    {
        return $this->name !== 'admin';
    }
    /**End Helper*/
}
