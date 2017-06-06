<?php

namespace App\Http\Controllers\Api;

use App\Group;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Validator;

class GroupController extends Controller
{
    public function index() {
        $user = User::where("api_key", Input::get("api_key"))->firstOrFail();
        return $user->groups()->with("servers")->get();
    }

    public function metrics($id) {
        $user = User::where("api_key", Input::get("api_key"))->firstOrFail();
        if($id != 0) {
            $toMetric = $user->groups()->where("id", $id)->with("servers")->first();
        } else {
            $toMetric = $user;
        }

        $group = new \App\Metrics\Group($toMetric);
        return json_encode($group);
    }

    public function view(Request $request, $id) {
        $user = User::where("api_key", Input::get("api_key"))->firstOrFail();
        return $user->groups()->where("id", $id)->with("servers")->first();
    }

    public function store(Request $request) {
        $user = User::where("api_key", Input::get("api_key"))->firstOrFail();
        $validator = Validator::make($request->all(), array(
            'name' => 'required|string|min:3|max:150'
        ));
        if($validator->fails()) {
            return array("success" => false, "errors" => $validator->errors()->getMessages());
        }

        $id = Input::get("id", null);
        if($id != null) {
            $group = \Auth::user()->groups()->where("id", $id)->findOrFail();
        } else {
            $group = new Group();
            $group->user_id = \Auth::user()->id;
        }

        $group->name = Input::get("name");
        if(in_array(Input::get("interval",false), array("1m","5m","15m","30m","1h","6h","12h","1d"))) {
            $group->interval = Input::get("interval");
        }

        $servers = Input::get("servers",false);
        if($servers) {
            $_toSync = [];
            foreach($servers as $server) {
                if(intval($server) == $user->user_id) {
                    $_toSync[] = intval($server);
                }
            }
            $group->servers()->sync($_toSync);
        }

        $group->save();

        return array("success" => true,"group" => $group);
    }



    public function delete(Request $request, $id) {
        $server = \Auth::user()->groups()->where("id", $id)->findOrFail();
        return array("success" => true);
    }



}
