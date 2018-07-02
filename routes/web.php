<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', 'TestController@index');


//public routes
Route::get('login', 'AuthController@form')->name('auth.form');
Route::post('login', 'AuthController@login')->name('login');

//private routes
Route::middleware('auth')->group(function() {
    Route::get('', 'HomeController@index')->name('home');
    Route::get('logout', 'AuthController@logout')->name('logout');
    Route::get('profile', 'HomeController@profileForm')->name('profile.form');
    Route::post('profile', 'HomeController@profileSave')->name('profile.save');
    Route::post('profile/changePassword', 'HomeController@changePassword')->name('profile.changePassword');
    Route::prefix('users')->group(function(){
        //users routes
        Route::get('', 'UserController@listUsers')->name('user.listUsers');
        Route::get('add', 'UserController@addUser')->name('user.addUser');
        Route::get('edit/{user}', 'UserController@editUser')->name('user.editUser');
        Route::post('save/{user?}', 'UserController@saveUser')->name('user.saveUser');
        Route::get('delete/{user}', 'UserController@deleteUser')->name('user.deleteUser');
        //users groups routes
        Route::get('groups', 'UserController@listGroups')->name('user.listGroups');
        Route::get('groups/add', 'UserController@addGroup')->name('user.addGroup');
        Route::get('groups/edit/{group}', 'UserController@editGroup')->name('user.editGroup');
        Route::post('groups/save/{group?}', 'UserController@saveGroup')->name('user.saveGroup');
        Route::get('groups/delete/{group}', 'UserController@deleteGroup')->name('user.deleteGroup');
        //users listRoles
        Route::get('roles', 'UserController@listRoles')->name('user.listRoles');
        Route::get('roles/add', 'UserController@addRole')->name('user.addRole');
        Route::get('roles/edit/{role}', 'UserController@editRole')->name('user.editRole');
        Route::post('roles/save/{role?}', 'UserController@saveRole')->name('user.saveRole');
        Route::get('roles/listPerms/{group}/{role?}', 'UserController@listPerms');
    });
});