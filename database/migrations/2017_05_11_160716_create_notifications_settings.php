<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("server_id");
            $table->string("notification")->nullable();
            $table->boolean("send_sms")->default(true);
            $table->boolean("send_email")->default(true);
            $table->boolean("send_notification")->default(true);
            $table->timestamps();
            $table->index(['user_id', 'server_id', 'notification_class']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications_settings');
    }

}
