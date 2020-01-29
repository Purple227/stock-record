<?php

use Illuminate\Http\Request;

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

Route::get('arrived/{date}', 'InventoryController@sortByDate');
Route::get('evacuated/{date}', 'InventoryEvacuationController@sortByDate');

Route::get('home/arrived', 'InventoryController@getBag');
Route::get('home/evacuated', 'InventoryEvacuationController@getBag');

Route::apiResources([
    'arrived' => 'InventoryController',
    'evacuated' => 'InventoryEvacuationController'
]);





































