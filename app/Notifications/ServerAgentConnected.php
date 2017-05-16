<?php

namespace App\Notifications;

use App\Server;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class ServerAgentConnected extends BaseServerNotification
{

    public function __construct($server) {
        parent::__construct($server);
    }

    public function className() {
        return __CLASS__;
    }

    public function toMail($notifiable)
    {
        $subject = Lang::get('notifications/ServerAgentConnected/email.title',["name" => strtoupper($this->server->name)], $this->locale);
        $text = Lang::get('notifications/ServerAgentConnected/email.text',["name" => strtoupper($this->server->name), "ip" => $this->server->ip], $this->locale);
        $action = Lang::get('notifications/ServerAgentConnected/email.action',["name" => strtoupper($this->server->name), "ip" => $this->server->ip], $this->locale);
        $thanks = Lang::get('notifications/ServerAgentConnected/email.thanks',[], $this->locale);
        $url = url('/');

        return (new MailMessage)
            ->subject($subject)
            ->line($text)
            ->action($action, $url)
            ->line($thanks);
    }

    public function toNexmo($notifiable)
    {
        $text = Lang::get('notifications/ServerAgentConnected/sms.text',["name" => strtoupper($this->server->name), "ip" => $this->server->ip], $this->locale);
        return (new NexmoMessage())
            ->content($text);
    }

    public static function toStringNotification($server)
    {
        $user = Auth::user();

        if ($user->locale != "" && $user->locale != null) {
            $locale = $user->locale;
        } else {
            $locale = "fr";
        }
        return array("type" => "alert", "text" => Lang::get('notifications/ServerAgentConnected/notification.text', ["name" => strtoupper($server->name), "ip" => $server->ip, "id" => $server->id], $locale));

    }


}
