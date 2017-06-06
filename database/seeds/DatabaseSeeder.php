<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        /*foreach (range(1,10) as $index) {
            DB::table('posts')->insert([
                'title' => $faker->text(120),
                'slug' => $faker->slug(6),
                'content' => $faker->text(500)
            ]);
        }*/

        DB::table('users')->insert([
            'name' => $faker->text(50),
            'email' => 'kevin.eggermont@gmail.com',
            'password' => '$2y$10$lnjWXD38QqP02Ct3O8kypel/lNWCLc3HzPyS7pGjINB7uXdnyFaG2',
            'remember_token' => 'lVmGOcsgOHItnlbqCqJBUhJhMUXz7c1LSqSMsjN8OTw7bkmc8pD51nHUrzvV',
            'api_key' => "kevin_api"
        ]);


        $faker = Faker::create();
        foreach (range(15,20) as $index) {
            DB::table('servers')->insert([
                'user_id' => 1,
                'hash' => 'aaaa',
                'service_tracking' => '[]',
                'agent_connected' => $faker->boolean(),
                'ip' => $faker->ipv4(),
                'geo_country' => $faker->country(),
                'geo_town' => $faker->city(),
                'name' => $faker->name()
            ]);
        }

    }
}
