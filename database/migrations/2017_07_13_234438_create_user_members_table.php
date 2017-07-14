<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_members', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('level')->unsigned()->default(0)->comment('会员级别 1:月度 2:季度 3:半年 4:年卡 5:2年 6:3年');
            $table->dateTime('start_time')->default('')->comment('开始时间');
            $table->dateTime('end_time')->default('')->comment('结束时间');
            $table->tinyInteger('status')->default(0)->comment('状态 0:无效 1:有效');
            $table->tinyInteger('user_id')->unsigned()->default(0)->comment('uid');
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
        Schema::drop('user_members');
    }
}
