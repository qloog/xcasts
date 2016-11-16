<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned()->default(0)->comment('所属课程id');
            $table->string('name')->comment('视频名称');
            $table->string('cover_image')->default('')->comment('封面图');
            $table->string('url')->comment('视频原url地址');
            $table->string('cdn_url')->default('')->comment('cdn地址');
            $table->tinyInteger('is_free')->unsigned()->default(0)->comment('是否免费 1:免费,0:收费');
            $table->integer('length')->unsigned()->default(0)->comment('视频长度');
            $table->integer('user_id')->unsigned()->default(0)->comment('用户id');
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
		Schema::drop('videos');
	}

}
