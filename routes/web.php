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
    // Route::get('/', 'UserController@list')->name('users.list');
    // Route::get('getItems', 'UserController@getItems')->name('users.getItems');
    // Route::get('edit/{user}', 'UserController@edit')->name('users.edit');
    // Route::post('save/{user?}', 'UserController@save')->name('users.save');
});

Route::get('/login', function () {
    return view('login');
});