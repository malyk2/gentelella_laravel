<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Test extends Model
{
    use NodeTrait;

    protected $fillable = [
        'name'
    ];
}
