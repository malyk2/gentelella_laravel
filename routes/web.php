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

Route::get('/', function () {
    return view('home');
});

//users routes
Route::prefix('users')->group(function(){
    Route::get('groups', 'UserController@listGroups')->name('users.listGroups');
    Route::get('groups/add', 'UserController@addGroup')->name('users.addGroup');
});

Route::get('/login', function () {
    return view('login');
});