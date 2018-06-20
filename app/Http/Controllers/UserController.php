<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Http\Requests\User\AddGroup as AddGroupRequest;

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
        $tree = Group::descendantsAndSelf(1)->toTree();
        return view('user.formGroup', compact('tree'));
    }

    public function saveGroup(AddGroupRequest $request, Group $group)
    {
        $data = $request->validated();
        $parent = Group::find($data['parent_id']);
        $parent->children()->create(['name' => $data['name']]);
        return redirect()->route('user.listGroups');
        // dd($data);
    }

}
