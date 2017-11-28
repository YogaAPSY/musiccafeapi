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
$api = app('Dingo\Api\Routing\Router');
$api->version('v1',function ($api) {
    $api->post('login', 'App\Http\Controllers\LaguController@login');
    $api->get('lagu', 'App\Http\Controllers\LaguController@index');
    $api->get('lagu/putar', 'App\Http\Controllers\PlayerController@index');
    $api->get('lagu/{id}', 'App\Http\Controllers\LaguController@show');
    $api->get('lagu/search/{keyword}', 'App\Http\Controllers\LaguController@search');
    $api->get('lagu/request/{id}', 'App\Http\Controllers\PlayerController@request');
    $api->get('lagu/refresh', 'App\Http\Controllers\PlayerController@refresh');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
