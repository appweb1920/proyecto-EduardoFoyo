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

//La bese de datos esta conectada con aws, no tiene la configuracion en el .env, la configuracion esta database.php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware'=>['auth']], function(){
    Route::get('/home', 'LoveController@index')->name('home');
    Route::get('/layout', 'LoveController@layout')->name('layout');
    Route::get('/lista/usuarios', 'LoveController@showUsers')->name('show_users');
    Route::get('/modifica/usuario/{id}', 'LoveController@modifyUser')->name('modify_user');
    Route::post('/editar/datos/usuario', 'LoveController@editUserData')->name('edit_user_data');
    Route::get('/add/interests/view', 'LoveController@addInterestView')->name('add_interest_view');
    Route::post('/add/interests', 'LoveController@addInterest')->name('add_interest');
    Route::get('/delete/user/{id}', 'LoveController@deleteUser')->name('delete_user');
});