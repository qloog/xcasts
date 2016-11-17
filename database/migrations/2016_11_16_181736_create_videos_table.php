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
            $table->string('name')->nullable()->comment('名称');
            $table->string('description')->nullable()->comment('描述');
            $table->string('origin_cover_image')->default('')->comment('源封面图');
            $table->string('cdn_cover_image')->default('')->comment('cdn封面图url');
            $table->string('origin_mp4_url')->default('')->comment('源视频原url地址');
            $table->string('cdn_mp4_url')->default('')->comment('cdn视频地址');
            $table->tinyInteger('is_free')->unsigned()->default(0)->comment('是否免费 0:收费, 1:免费');
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
