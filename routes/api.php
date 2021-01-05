<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create/love/user', 'ApiRestController@createLoveUser')->name('create_love_user');
Route::post('/login/love/user', 'ApiRestController@loginLoveUser')->name('login_love_user');

Route::post('/list/users', 'ApiRestController@listUsers')->name('list_user_api');
Route::post('/users/recommended', 'ApiRestController@usersRecommended')->name('users_recommended');

Route::post('/get/user', 'ApiRestController@getUser')->name('get_user');
Route::post('/edit/user/data', 'ApiRestController@editUserData')->name('edit_user_data');///

Route::post('/relate/user/interests', 'ApiRestController@relateUserInterests')->name('relate_user_interests');///

Route::get('/get/interest', 'ApiRestController@getInterest')->name('get_interest');///

Route::post('/like', 'ApiRestController@like')->name('like');
Route::post('/get/user/matches', 'ApiRestController@getUserMatches')->name('get_user_matches');