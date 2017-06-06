<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id");
            $table->string("hash");
            $table->string("service_tracking");
            $table->string("uptime")->default(null)->nullable();
            $table->string("system")->default(null)->nullable();
            $table->string("os")->default(null)->nullable();
            $table->string("networks")->default(null)->nullable();
            $table->string("cpus")->default(null)->nullable();
            $table->string("total_mem")->default(null)->nullable();
            $table->string("name");
            $table->string("agent_connected")->default(0);
            $table->string("ip")->nullable();
            $table->string("geo_country")->nullable();
            $table->string("geo_town")->nullable();
            $table->string("isp_info")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');
    }
}
