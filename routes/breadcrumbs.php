<?php
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Домівка', route('home'));
});

Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('home');
    $trail->push('Профіль', route('profile.form'));
});

Breadcrumbs::for('user.listUsers', function ($trail) {
    $trail->parent('home');
    $trail->push('Користувачі', route('user.listUsers'));
});

Breadcrumbs::for('user.editAddUser', function ($trail, $item) {
    $trail->parent('user.listUsers');
    if ( ! empty($item)) {
        $trail->push($item->name, route('user.editUser', $item));
    } else {
        $trail->push('Створення користувача', route('user.addUser'));
    }
});

Breadcrumbs::for('user.listGroups', function ($trail) {
    $trail->parent('home');
    $trail->push('Групи користувачів', route('user.listGroups'));
});

Breadcrumbs::for('user.editAddGroup', function ($trail, $item) {
    $trail->parent('user.listGroups');
    if ( ! empty($item)) {
        $trail->push($item->name, route('user.editUser', $item));
    } else {
        $trail->push('Створення групи', route('user.addGroup'));
    }
});

Breadcrumbs::for('user.listRoles', function ($trail) {
    $trail->parent('home');
    $trail->push('Ролі', route('user.listRoles'));
});

Breadcrumbs::for('user.editAddRole', function ($trail, $item) {
    $trail->parent('user.listRoles');
    if ( ! empty($item)) {
        $trail->push($item->name, route('user.editRole', $item));
    } else {
        $trail->push('Створення ролі', route('user.addRole'));
    }
});