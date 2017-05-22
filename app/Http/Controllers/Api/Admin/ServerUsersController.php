<?php

namespace App\Http\Controllers\Api\Admin;

use App\Server;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ServerUsersController extends Controller
{
    public function update($server_id, Request $request) {

        $server = Server::where("id", $server_id)->first();
        if(!$server) {
            return response([
                'error' => [
                    'code' => 'SERVER_NOT_FOUND',
                    'description' => 'The server was not found.'
                ]
            ], 404);
        }

        $toUpdate = false;

        if(Input::get("ip",null) && $server->ip != Input::get("ip",false)) {
            $server->ip = Input::get("ip");
            $toUpdate = true;
        }

        if(Input::get("hostname",null)) {
            if($server->name == null || $server->name == "") {
                $server->name = Input::get("name");
                $toUpdate = true;
            }
        }

        if(Input::get("is_connected",null) != null && is_bool(Input::get("is_connected"))) {
            $server->agent_connected = Input::get("is_connected");
            $toUpdate = true;
        }

        if($toUpdate) {
            $server->save();
        }
        return array("success" => true, "data" => array($server));
    }
}
