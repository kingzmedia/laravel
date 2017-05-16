<?php

namespace Tests\Unit;

use App\Notifications\ServerAgentConnected;
use App\Notifications\ServerAgentDisconnected;
use App\NotificationsSettings;
use App\Post;
use App\Server;
use App\ServerSettings\Notifications;
use App\User;
use Kingzmedia\Comments\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServersTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */


    public function testServers()
    {

        // Création de l'utilisateur
        $this->user = User::create(["name" => "test", "email" => "john@doe.com", "password" => "azerty", "locale" => "en"]);
        $user2 = User::create(["name" => "touille", "email" => "user2@john.com", "password" => "azerty"]);
        $user3 = User::create(["name" => "sdsfdsfsd", "email" => "user3@john.com", "password" => "azerty"]);


        // Vérification de l'existance des users
        $this->assertEquals(3, User::count());

        // Création d'un commentaire de l'utilisateur 1 sur le post 1
        $server = new Server();
        $server->user_id  = $this->user->id;
        $server->name = "Nom";
        $server->ip = "127.0.0.1";
        $server->save();

        /*/
        $server->name = "Nom2";
        $server->save();
*/


        $this->assertEquals(1, Server::count());
        $server = Server::first();
        $this->assertEquals(1, sizeof($server->notifications()->get()->count()));
    }


    public function testApi() {


    }
}
