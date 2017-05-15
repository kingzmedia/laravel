<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer("sms_credits")->unsigned()->default(0);
            $table->integer("premium_id")->unsigned()->nullable();
            $table->string("locale")->default("fr");
            $table->dateTime("premium_expiration")->nullable()->default(null);
            $table->index(['premium_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
