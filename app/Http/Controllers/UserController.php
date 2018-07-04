<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\Permission;
use App\Role;
use App\Http\Requests\User\SaveGroup as SaveGroupRequest;
use App\Http\Requests\User\SaveUser as SaveUserRequest;
use App\Http\Requests\User\SaveRole as SaveRoleRequest;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    public function listGroups()
    {
        $this->authorize('manage', Group::class);
        $tree = auth()->user()->getTreeAllGroups(['users', 'roles', 'descendants.users']);
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
        $this->authorize('edit', $group);
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
        if (auth()->user()->can('groups', Permission::class)) {
            $perms = array_key_exists('perms', $data) ? array_keys($data['perms']) : [];
            $group->permissions()->sync($perms);
        }
        return redirect()->route('user.listGroups')->pnotify('Дані збережено', '','success');
    }

    public function deleteGroup(Group $group)
    {
        $this->authorize('delete', $group);
        $group->delete();
        return redirect()->route('user.listGroups')->pnotify('Групу видалено.', '','success');
    }

    public function listUsers()
    {
        $this->authorize('manage', User::class);
        $userGroupsIds = auth()->user()->getAllGroups()->pluck('id');
        $users = User::with('group.ancestors', 'roles')->whereIn('group_id', $userGroupsIds)->get();
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
        $this->authorize('edit', $user);
        $item = $user->load('roles', 'group.roles');
        $groupsTree = auth()->user()->getTreeAllGroups();
        return view('user.formUser', compact('item', 'groupsTree'));
    }

    public function saveUser(SaveUserRequest $request, User $user)
    {
        $this->authorize('manage', User::class);
        $data = $request->validated();
        $user->fill($data);
        $user->save();
        $roles = array_key_exists('roles', $data) ? $data['roles'] : [];
        $user->roles()->sync($roles);
        return redirect()->route('user.listUsers')->pnotify('Дані збережено', '','success');
    }

    public function deleteUser(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('user.listUsers')->pnotify('Користувача видалено.', '','success');
    }

    public function listRoles()
    {
        $this->authorize('manage', Role::class);
        $userGroupsIds = auth()->user()->getAllGroups()->pluck('id');
        $roles = Role::with('group.ancestors','users')->whereIn('group_id', $userGroupsIds)->get();
        return view('user.listRoles', compact('roles'));
    }

    public function addRole()
    {
        $this->authorize('manage', Role::class);
        $groupsTree = auth()->user()->getTreeAllGroups();
        return view('user.formRole', compact('groupsTree'));
    }

    public function saveRole(SaveRoleRequest $request, Role $role)
    {
        $this->authorize('manage', Role::class);
        $data = $request->validated();
        $role->fill($data);
        $role->save();
        $perms = array_key_exists('perms', $data) ? array_keys($data['perms']) : [];
        $role->permissions()->sync($perms);
        return redirect()->route('user.listRoles')->pnotify('Успіх', 'Дані збережено', 'success');
    }

    public function editRole(Role $role)
    {
        $this->authorize('edit', $role);
        $item = $role->load('group.permissions');
        $groupsTree = auth()->user()->getTreeAllGroups();
        return view('user.formRole', compact('item', 'groupsTree'));
    }

    public function deleteRole(Role $role)
    {
        $this->authorize('delete', $role);
        $role->delete();
        return redirect()->route('user.listRoles')->pnotify('Успіх', 'Роль видалено.','success');
    }

    public function getPerms(Group $group, Role $role)
    {
        $group->load('permissions');
        $permissions = $group->permissions;
        $item = $role->load('permissions');
        return view('user.checkboxesPermissions', compact('permissions', 'item'));
    }

    public function getRoles(Group $group)
    {
        $group->load('roles');
        $roles = $group->roles;
        return view('user.selectRoles', compact('roles'));
    }
}
