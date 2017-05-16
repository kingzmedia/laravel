<?php

namespace App\Listeners;

use App\Notifications\ServerAgentConnected;
use App\Notifications\ServerAgentDisconnected;
use App\Notifications\ServerCreated;
use App\Notifications\UserCreated;
use App\ServerSettings\Notifications;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Kingzmedia\Comments\Comment;
use Kingzmedia\Comments\Notifications\CommentCreated;
use Kingzmedia\Comments\Notifications\CommentResponse;

class ServersEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function beforeServerUpdate($server)
    {
        Event::fire("server.updating", array($server));
        return true;
    }

    public function onServerUpdate($server)
    {
        Event::fire("server.updated", array($server));
        $old = \App\Server::where("id", $server->id)->first();

        if ($old->name != $server->name) {
            Event::fire("server.update.name", array($server, $old->name, $server->name));
        }
        if ($old->agent_connected != $server->agent_connected) {
            if ($server->agent_connected == true || $server->agent_connected == 1 || $server->agent_connected == "1") {
                Event::fire("server.agent.connected", array($server));
                $server->user()->first()->notify(new ServerAgentConnected($server));
            } else {
                Event::fire("server.agent.disconnected", array($server));
                $server->user()->first()->notify(new ServerAgentDisconnected($server));
            }
        }
    }

    public function beforeServerCreation($server)
    {
        Event::fire("server.creating", array($server));
        return true;
    }

    public function onServerCreated($server)
    {
        Event::fire("server.created", array($server));
        $server->user()->first()->notify(new ServerCreated($server));

        // Configure notifications settings
        new Notifications($server);
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {

        $events->listen(
            'eloquent.created: App\Server',
            'App\Listeners\ServersEventSubscriber@onServerCreated'
        );

        $events->listen(
            'eloquent.creating: App\Server',
            'App\Listeners\ServersEventSubscriber@beforeServerCreation'
        );

        $events->listen(
            'eloquent.updated: App\Server',
            'App\Listeners\ServersEventSubscriber@onServerUpdate'
        );

        $events->listen(
            'eloquent.updating: App\Server',
            'App\Listeners\ServersEventSubscriber@beforeServerUpdate'
        );
    }

}