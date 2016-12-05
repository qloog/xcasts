<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('username')->unique();
                $table->string('email')->unique();
                $table->string('password', 60);
                $table->tinyInteger('status')->default(1);
                $table->timestamp('last_login_time')->default('');
                $table->ipAddress('last_login_ip')->default('');
                $table->softDeletes();
                $table->rememberToken();
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
        Schema::drop('users');
    }
}
