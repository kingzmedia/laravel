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

Route::middleware('App\Http\Middleware\CheckToken')->get('/v1/servers','Api\ServerController@index')->name("api_server_index");
Route::get('/v1/server/{id}','Api\ServerController@view')->where("id","[0-9+]")->name("api_server_view");
Route::post('/v1/server/{id}','Api\ServerController@update')->where("id","[0-9+]")->name("api_server_update_id");
Route::post('/v1/server','Api\ServerController@update')->name("api_server_create");
Route::delete('/v1/server/{id}','Api\ServerController@delete')->where("id","[0-9+]")->name("api_server_delete");

Route::get('/v1/server/{serverId}/notification/{notificationId}', 'Api\ServerController@updateNotificationSettings')->name("api_server_update_notification");