<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;

class UserController extends Controller
{
    public function listGroups()
    {
        // dd('listGroups');
        // $root = Group::find(Group::ID_ROOT);
        // $root->children()->create(['name' => 'name1']);
        // $root->children()->create(['name' => 'name2']);
        // $root->child
        $tree = Group::descendantsAndSelf(1)->toTree();
        // $tree = Group::descendantsAndSelf(1)->toFlatTree()->toArray();
        // dd($tree);

        return view('user.listGroups', compact('tree'));
    }

    public function addGroup()
    {
        // dd('add');
        return view('user.formGroup');
    }

}
