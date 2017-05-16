<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class ServerCreated extends Notification
{
    use Queueable;

    public $server;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($server)
    {
        $this->server = $server;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public static function toStringNotification($server)
    {
        $user = Auth::user();

        if ($user->locale != "" && $user->locale != null) {
            $locale = $user->locale;
        } else {
            $locale = "fr";
        }
        return array("type" => "success", "text" => Lang::get('notifications/ServerCreated/notification.text', ["name" => strtoupper($server->name), "ip" => $server->ip, "id" => $server->id], $locale));

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
            "time" => time()
            //
        ];
    }
}
