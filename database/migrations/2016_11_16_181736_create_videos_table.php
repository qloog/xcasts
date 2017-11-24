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
            $table->integer('episode_id')->unsigned()->default(0)->comment('episode_id');
            $table->string('name')->nullable()->comment('名称');
            $table->string('description')->nullable()->comment('描述');
            $table->string('cover_image')->default('')->comment('封面图');
            $table->string('mp4_url')->default('')->comment('视频url地址');
            $table->tinyInteger('is_free')->unsigned()->default(0)->comment('是否免费 0:收费, 1:免费');
            $table->string('length', 10)->unsigned()->default('')->comment('视频长度');
            $table->tinyInteger('is_publish')->unsigned()->default(0)->comment('是否发布 0:否, 1:是');
            $table->timestamp('published_at')->comment('发布时间');
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
