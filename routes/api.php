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
Route::get('/track/{id}', 'TrackController@getTrack');
Route::get('/search/{type}/{query}', 'TrackController@search');

Route::middleware('auth:api')->group(function () {
    //Cuando esta loggeado
});
