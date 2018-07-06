<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Group extends Model
{
    use SoftDeletes, NodeTrait;

    const ROOT_ID = 1;
    const ROOT_NAME = 'root';

    protected $fillable = [
        'name',
        'active',
    ];

    protected $dates = ['deleted_at'];

    /**Start relations */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    public function parent()
    {
        return $this->belongsTo(Group::class);
    }

    public function roles()
    {
        return $this->hasMany(Role::class);
    }
    /**End relations */

    /**Start Mutators*/
    public function getFullNameAttribute()
    {
        $delimiter = '-';
        $fullName = '';
        foreach($this->ancestors as $item) {
            $fullName .= $item->name.$delimiter;
        }
        $fullName .= $this->name;
        return $fullName;
    }

    /**End mutators */

    /**Start Helper*/
    public function canEdit()
    {
        return ! ($this->isRoot() || $this->isCurrent());
    }

    public function canDelete()
    {
        return ! ($this->isRoot() || $this->hasUsers() || $this->descendantsHasUsers() || $this->hasRoles());
    }

    public function isCurrent()
    {
        return $this->id == auth()->user()->group_id;
    }

    public function hasUsers()
    {
        return $this->users->isNotEmpty();
    }

    public function descendantsHasUsers()
    {
        foreach($this->descendants as $item) {
            if($item->users->isNotEmpty()) {
                return true;
            }
        }
        return false;
    }

    public function hasRoles()
    {
        return $this->roles->isNotEmpty();
    }

    public function belogsUser(User $user)
    {
        return $user->getAllGroups()->contains('id', $this->id);
    }

    public function isRoot()
    {
        return $this->name == self::ROOT_NAME;
    }
    /**End Helper*/

}
