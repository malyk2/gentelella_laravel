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
    /**End relations */

    /**Start Mutators*/
    /**End mutators */

    /**Start Helper*/
    public function canEdit()
    {
        return true;
    }

    public function canDelete()
    {
        return true;
    }

    /**End Helper*/
}
