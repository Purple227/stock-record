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

/*Route::get('/', function () {
    return view('play');
});*/

/*Route::put('user/update/{id}', 'UserController@updateProfile')->name('update');
Route::get('guard', 'UserController@loginGuard');
Route::get('user/profile', 'UserController@showProfile');
*/

Route::post('user/update', 'UserController@update');
Route::resource('user', 'UserController');

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::get('/{any}', 'HomeController@index')->where('any', '.*');





















































