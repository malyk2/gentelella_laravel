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

}
