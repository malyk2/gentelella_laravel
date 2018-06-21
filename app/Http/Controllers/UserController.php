<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\Http\Requests\User\SaveGroup as SaveGroupRequest;
use App\Http\Requests\User\SaveUser as SaveUserRequest;

class UserController extends Controller
{
    public function listGroups()
    {
        // dd('listGroups');
        // $root = Group::find(Group::ID_ROOT);
        // $root->children()->create(['name' => 'name1']);
        // $root->children()->create(['name' => 'name2']);
        // $root->child
        // $tree = Group::descendantsAndSelf(1)->toTree();
        // $tree = Group::descendantsAndSelf(1)->toFlatTree()->toArray();
        // dd($tree);
        $tree = auth()->user()->getTreeAllGroups();
        return view('user.listGroups', compact('tree'));
    }

    public function addGroup()
    {
        $tree = Group::descendantsAndSelf(1)->toTree();
        return view('user.formGroup', compact('tree'));
    }

    public function saveGroup(SaveGroupRequest $request, Group $group)
    {
        $data = $request->validated();
        $parent = Group::find($data['parent_id']);
        $parent->children()->create(['name' => $data['name']]);
        return redirect()->route('user.listGroups');
    }

    public function listUsers()
    {
        $userGroupsIds = auth()->user()->getAllGroups()->pluck('id');
        $users = User::with('group.ancestors')->whereIn('group_id', $userGroupsIds)->get();
        return view('user.listUsers', compact('users'));
    }

    public function addUser()
    {
        $groupsTree = auth()->user()->getTreeAllGroups();
        return view('user.formUser', compact('groupsTree'));
    }

    public function saveUser(SaveUserRequest $request)
    {
        dd($request->validated());
    }

}
