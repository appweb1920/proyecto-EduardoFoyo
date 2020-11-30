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

Route::get('/home', 'LoveController@index')->name('home');
Route::get('/layout', 'LoveController@layout')->name('layout');
Route::get('/lista/usuarios', 'LoveController@showUsers')->name('show_users');
Route::get('/modifica/usuario/{id}', 'LoveController@modifyUser')->name('modify_user');
