<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Group extends Model
{
    use NodeTrait;

    const ID_ROOT = 1;

    protected $fillable = [
        'name'
    ];

    /**Start relations */
    public function users()
    {
        return $this->hasMany(User::class);
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
    /**End Helper*/

}
