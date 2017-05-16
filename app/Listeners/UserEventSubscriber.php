<?php

namespace App\Listeners;

use App\Notifications\UserCreated;
use App\Notifications\UserSmsLowCredits;
use App\Notifications\UserSmsNoCredits;
use App\ServerSettings\Notifications;
use App\User;
use Illuminate\Support\Facades\Event;

class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function onUserLogin($user) {

        // Checking notifications settings
        new Notifications(null,$user);
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event) {}

    public function onUserUpdating($user) {
        $old = User::where("id",$user->id)->first();


        // Case of SMS USE
        if($old->sms_credits > $user->sms_credits) {
            if($user->sms_credits == 20) {
                Event::fire("user.sms.20_credits_left", array($user));
            }
            if($user->sms_credits == 10) {
                $user->notify(new UserSmsLowCredits());
                Event::fire("user.sms.10_credits_left", array($user));
            }
            if($user->sms_credits == 5) {
                Event::fire("user.sms.5_credits_left", array($user));
            }
            if($user->sms_credits == 0) {
                Event::fire("user.sms.no_credits", array($user));
                $user->notify(new UserSmsNoCredits());
            }
            Event::fire("user.sms_used", array($user));
        }
    }

    public function onSmsSend($user) {
        $user->sms_credits = ($user->sms_credits-1);
        $user->save();
    }



    public function onUserRegister(User $user) {
        $user->notify(new UserCreated());
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@onUserLogout'
        );

        $events->listen(
            'eloquent.created: App\User',
            'App\Listeners\UserEventSubscriber@onUserRegister'
        );

        $events->listen(
            'eloquent.updating: App\User',
            'App\Listeners\UserEventSubscriber@onUserUpdating'
        );

        $events->listen(
            'sms.send',
            'App\Listeners\UserEventSubscriber@onSmsSend'
        );
    }

}