<?php

namespace App\Http\Controllers\Api;

use App\Server;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Validator;

class ServerController extends Controller
{
    public function index() {
        $user = User::where("api_key", Input::get("api_key"))->firstOrFail();
        return $user->servers()->with('notifications')->get();
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), array(
            'name' => 'required|string'
        ));
        if($validator->fails()) {
            return array("success" => false, "errors" => $validator->errors()->getMessages());
        }

        $id = Input::get("id", null);
        if($id != null) {
            $server = \Auth::user()->servers()->where("id", $id)->findOrFail();
        } else {
            $server = new Server();
            $server->user_id = \Auth::user()->id;
        }

        $server->name = Input::get("name");

    }

    public function view(Request $request, $id) {
        return \Auth::user()->servers()->where("id", $id)->findOrFail();
    }

    public function delete(Request $request, $id) {
        $server = \Auth::user()->servers()->where("id", $id)->findOrFail();
        return array("success" => true);
    }

    public function updateNotificationSettings(Request $request, $serverId, $notificationId) {
        $user = User::where("api_key", Input::get("api_key"))->firstOrFail();
        $notification = $user->servers()->where("id", $serverId)->firstOrFail()->notifications()->where("id",$notificationId)->firstOrFail();

        if(Input::get("send_sms_to",false)) {
            $notification->send_sms_to = Input::get("send_sms_to");
        }
        if(Input::get("send_email_to",false)) {
            $notification->send_email_to = Input::get("send_email_to");
        }
        if(Input::get("send_notification",false)) {
            if(Input::get("send_notification") == "1") { $value = 1; } else { $value = 0; }
            $notification->send_notification = $value;
        }
        $notification->save();

        return array("success" => true, "data" => $notification);

    }


}
