<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUsers()
    {
        $user = User::create(["name" => "User1","email" => "kevin.eggermont@gmail.com","password" => "mdpssss"]);
        $this->assertEquals(1, User::count());

        foreach ($user->unreadNotifications as $notification) {
            //var_dump(($notification->type)::toString($notification));
        }
        $this->assertEquals(sizeof($user->unreadNotifications), 1);
    }
}
