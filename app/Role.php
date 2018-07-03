<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    const ROOT_NAME = 'root';

    protected $fillable = [
        'name',
        'group_id',
    ];
    /**Start relations */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    /**End relations */

    /**Start Mutators*/
    /**End mutators */

    /**Start Helper*/
    public function canEdit()
    {
        return ! ($this->isRoot());
    }

    public function canDelete()
    {
        return ! ($this->isRoot() || $this->isCurrent() || $this->hasUsers());
    }

    public function hasUsers()
    {
        return $this->users->isNotEmpty();
    }

    public function isCurrent()
    {
        return auth()->user()->roles->contains('id', $this->id);
    }

    public function belogsUser(User $user)
    {
        return $user->getAllGroups()->contains('id', $this->group_id);
    }

    public function isRoot()
    {
        return $this->name == self::ROOT_NAME;
    }

    /**End Helper*/
}
