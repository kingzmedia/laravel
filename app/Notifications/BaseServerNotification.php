<?php

namespace App\Notifications;

use App\Server;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Event;

class BaseServerNotification extends Notification
{
    use Queueable;


    public function __construct($server) {
        $this->server = $server;
        $this->user = $server->user()->first();
        $this->locale = $this->user->locale;
        if($this->locale == null || $this->locale == "") { $this->locale = "fr"; }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if(!method_exists($this,"className")) {
            throw new \Exception("Notification from BaseServerNotification must implement className()");
        }

        $configuration = $this->server->notifications()->where("notification", $this->className())->where("server_id",$this->server->id)->first(); // ->where("notification", ServerAgentConnected::class)
        $user = $this->user;
        $notify = [];



        if($configuration) {

            // E-mail system
            if($configuration->send_email_to != null) {
                if($configuration->send_email_to == "") {
                    $notifiable->email = $user->email;
                } else {
                    $notifiable->email = $configuration->send_email_to;
                }
                Event::fire("notification.email.send", array($user, $notifiable->email));
                $notify[] = "mail";
            }

            // SMS system
            if(method_exists($this, "toNexmo")) {
                if($configuration->send_sms_to != null) {
                    if($user->sms_credits > 0) {
                        if($configuration->send_sms_to == "") {
                            $notifiable->phone_number = $user->phone_number;
                        } else {
                            $notifiable->phone_number = $configuration->send_sms_to;
                        }
                        Event::fire("sms.send", array($user, $notifiable->phone_number));
                        $notify[] = "nexmo";
                    }
                }
            }
        }

        $notify[] = "database";
        return $notify;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "server_id" => $this->server->id,
            "user_id" => $notifiable->id
        ];
    }

}