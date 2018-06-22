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
        $this->authorize('manage', Group::class);
        $tree = auth()->user()->getTreeAllGroups();
        return view('user.listGroups', compact('tree'));
    }

    public function addGroup()
    {
        $this->authorize('manage', Group::class);
        $user = auth()->user();
        $tree = $user->getTreeAllGroups();
        $permissions = $user->group->permissions;
        return view('user.formGroup', compact('tree', 'permissions'));
    }

    public function saveGroup(SaveGroupRequest $request, Group $group)
    {
        $this->authorize('manage', Group::class);
        $data = $request->validated();
        $parent = Group::find($data['parent_id']);
        $parent->children()->create(['name' => $data['name']]);
        return redirect()->route('user.listGroups');
    }

    public function listUsers()
    {
        $this->authorize('manage', User::class);
        $userGroupsIds = auth()->user()->getAllGroups()->pluck('id');
        $users = User::with('group.ancestors')->whereIn('group_id', $userGroupsIds)->get();
        return view('user.listUsers', compact('users'));
    }

    public function addUser()
    {
        $this->authorize('manage', User::class);
        $groupsTree = auth()->user()->getTreeAllGroups();
        return view('user.formUser', compact('groupsTree'));
    }

    public function saveUser(SaveUserRequest $request, User $user)
    {
        $this->authorize('manage', User::class);
        $data = $request->validated();
        $user->fill($data);
        $user->save();
        return redirect()->route('user.listUsers')->pnotify('Користувача створено', '','success');
    }

}
