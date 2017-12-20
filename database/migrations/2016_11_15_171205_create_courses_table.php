<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('课程名称');
            $table->enum('type', ['backend','frontend','service','tool'])->comment('课程分类');
            $table->text('description')->comment('课程描述');
            $table->string('slug')->unique()->comment('slug');
            $table->string('cover_image')->default('')->comment('课程封面图');
            $table->integer('user_id')->unsigned()->default(0)->index()->comment('创建者id');
            $table->tinyInteger('is_publish')->unsigned()->default(0)->comment('是否发布 0:否, 1:是');
            $table->timestamp('published_at')->comment('发布时间');
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
		Schema::drop('courses');
	}
}
