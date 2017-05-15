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
            $table->integer("server_id")->unsigned();
            $table->integer("user_id")->unsigned();
            $table->string("notification");
            $table->string("send_sms_to")->nullable()->default(null);
            $table->string("send_email_to")->nullable()->default(null);
            $table->boolean("send_notification")->default(true);
            $table->timestamps();
            $table->index(['notification','server_id']);
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
