<?php

namespace App\ServerSettings;

use App\NotificationsSettings;
use App\Server;

class Notifications {

    private $updater = [];

    public function __construct($server = false, $user = false)
    {


        $this->updater[] = array("notification" => \App\Notifications\ServerAgentConnected::class, "send_email_to" => "", "send_sms_to" => "");
        $this->updater[] = array("notification" => \App\Notifications\ServerAgentDisconnected::class, "send_email_to" => "", "send_sms_to" => "");

        if($server && !$user) {
            $user = $server->user()->first();
            $this->runChecker($server, $user);
        } elseif(!$server && $user) {
            $servers = $user->servers()->get();
            foreach($servers as $server) {
                $this->runChecker($server, $user);
            }
        } else {
            $servers = Server::all();
            foreach($servers as $server) {
                $user = $server->user()->first();
                $this->runChecker($server, $user);
            }
        }
    }

    private function runChecker($server,$user) {

        foreach($this->updater as $updater) {
            $data = NotificationsSettings::where("notification", $updater["notification"])->where("server_id", $server->id)->where("user_id", $user->id)->first();
            if (!$data) {
                $notif = new NotificationsSettings();
                $notif->user()->associate($user);
                $notif->server()->associate($server);
                $notif->send_email_to = $updater["send_email_to"];
                $notif->send_sms_to = $updater["send_sms_to"];
                $notif->notification = $updater["notification"];
                $notif->save();
            }
        }

    }

}