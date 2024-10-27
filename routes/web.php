<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['custom_permission', 'XssSanitizer'])->group(function () {
    Route::get('/user/delete/{id}', 'UserController@delete')->name('user.delete');
    Route::resource('/user', 'UserController');
    Route::get('/role/delete/{id}', 'RoleController@delete')->name('role.delete');
    Route::resource('/role', 'RoleController');
    Route::get('/menu-item/delete/{id}', 'MenuItemController@delete')->name('menu-item.delete');
    Route::resource('/menu-item', 'MenuItemController');
});
