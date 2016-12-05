<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unique()->comment('用户id');
            $table->string('avatar')->default('')->comment('头像');
            $table->string('realname')->default('')->comment('真实姓名');
            $table->string('city')->default('')->comment('所在城市');
            $table->string('company')->default('')->comment('所在公司');
            $table->string('weibo')->default('')->comment('微博');
            $table->string('wechat')->default('')->comment('微信');
            $table->string('website')->default('')->comment('个人网站');
            $table->string('introduction')->default('')->comment('自我介绍');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
