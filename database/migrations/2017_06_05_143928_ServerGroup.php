<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServerGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function(Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id");
            $table->string('name');
            $table->string('interval')->default("5m");
            $table->timestamps();
        });

        Schema::create('group_server', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('server_id')->unsigned()->index();
            $table->integer('group_id')->unsigned()->index();
            //$table->foreign("server_id")->references("id")->on("servers")->onDelete("cascade");
            //$table->foreign("servergroup_id")->references("id")->on("servergroups")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servergroups');
        Schema::dropIfExists('server_servergroups');
    }
}
