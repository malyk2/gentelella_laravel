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

    public function editGroup(Group $group)
    {
        abort_if( ! $group->canEdit(), 404);
        $item = $group->load('permissions', 'users');
        $user = auth()->user();
        $tree = $user->getTreeAllGroups();
        $permissions = $user->group->permissions;
        return view('user.formGroup', compact('item', 'tree', 'permissions'));
    }

    public function saveGroup(SaveGroupRequest $request, Group $group)
    {
        $this->authorize('manage', Group::class);
        $data = $request->validated();
        if ( ! $group->exists ) {
            $parent = Group::find($data['parent_id']);
            $group = $parent->children()->create(['name' => $data['name']]);
        } else {
            $group->update(['name' => $data['name']]);
        }
        $perms = array_key_exists('perms', $data) ? array_keys($data['perms']) : [];
        $group->permissions()->sync($perms);
        return redirect()->route('user.listGroups')->pnotify('Дані збережено', '','success');
    }

    public function deleteGroup(Group $group)
    {
        abort_if( ! $group->canDelete(), 404);
        $group->delete();
        return redirect()->route('user.listGroups')->pnotify('Групу видалено.', '','success');
    }

    public function listUsers()
    {
        $this->authorize('manage', User::class);
        $userGroupsIds = auth()->user()->getAllGroups()->pluck('id');
        $users = User::with('group.ancestors')->whereIn('group_id', $userGroupsIds)->where('id', '<>', auth()->id())->get();
        return view('user.listUsers', compact('users'));
    }

    public function addUser()
    {
        $this->authorize('manage', User::class);
        $groupsTree = auth()->user()->getTreeAllGroups();
        return view('user.formUser', compact('groupsTree'));
    }

    public function editUser(User $user)
    {
        abort_if( ! $user->canEdit(), 404);
        $this->authorize('manage', User::class);
        $item = $user->load('group');
        $groupsTree = auth()->user()->getTreeAllGroups();
        return view('user.formUser', compact('item', 'groupsTree'));
    }

    public function saveUser(SaveUserRequest $request, User $user)
    {
        $this->authorize('manage', User::class);
        $data = $request->validated();
        $user->fill($data);
        $user->save();
        return redirect()->route('user.listUsers')->pnotify('Дані збережено', '','success');
    }

    public function deleteUser(User $user)
    {
        abort_if( ! $user->canDelete(), 404);
        $user->delete();
        return redirect()->route('user.listUsers')->pnotify('Користувача видалено.', '','success');
    }

}
