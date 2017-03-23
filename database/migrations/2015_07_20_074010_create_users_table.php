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
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('avatar')->default('')->comment('头像');
            $table->string('real_name')->default('')->comment('真实姓名');
            $table->string('city')->default('')->comment('所在城市');
            $table->string('company')->default('')->comment('所在公司');
            $table->string('weibo_url')->default('')->comment('微博');
            $table->string('wechat_id')->default('')->comment('微信');
            $table->string('personal_website')->default('')->comment('个人网站');
            $table->string('introduction')->default('')->comment('自我介绍');
            $table->integer('topic_count')->default(0)->index();
            $table->integer('reply_count')->default(0)->index();
            $table->integer('follower_count')->default(0)->index();
            $table->integer('notification_count')->default(0)->index();
            $table->tinyInteger('status')->default(1);
            $table->timestamp('last_login_time')->default('0000-00-00 00:00:00');
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
