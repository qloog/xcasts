<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('series_id')->unsigned()->default(0)->comment('所属系列id');
            $table->string('name')->nullable()->comment('名称');
            $table->string('description')->nullable()->comment('描述');
            $table->string('cover_image')->default('')->comment('封面图');
            $table->string('mp4_url')->default('')->comment('视频url地址');
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
		Schema::drop('lessons');
	}

}
