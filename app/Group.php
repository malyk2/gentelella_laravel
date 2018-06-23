<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Group extends Model
{
    use SoftDeletes, NodeTrait;

    protected $fillable = [
        'name'
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
        return $this->parent_id !== null;
    }

    public function canDelete()
    {
        return $this->parent_id !== null;
    }
    /**End Helper*/

}
