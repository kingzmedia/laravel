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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//middleware('App\Http\Middleware\CheckAdminToken')->
Route::post('/v1/admin/server/{id}/update', 'Api\Admin\ServerUpdateController@update')->where("id","[0-9+]")->name("api_admin_server_update");
