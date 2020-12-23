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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('index');

// Rutas para Usuarios
Route::group(['middleware' => 'auth'], function() {
        // Rutas para borrado y restauracion
        Route::get('/users/trash','UserController@trashed')
        ->name('users.trashed')
        ->middleware('auth');
        Route::get('/users/{user}/restore','UserController@restore')
        ->name('users.restore');
        Route::patch('/users/{user}/trash','UserController@trash')
        ->name('users.trash')
        ->middleware('permission:users.destroy');
        // Rutas para CRUD
        Route::Resource('users', 'UserController');
});
