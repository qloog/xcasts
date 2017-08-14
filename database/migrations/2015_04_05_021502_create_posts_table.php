<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title');
            $table->string('slug')->default('');
            $table->string('summary')->default('');
            $table->text('origin_content');
            $table->text('content');
            $table->tinyInteger('status')->default(0)->comment('0:草稿 1:已发布');
            $table->integer('user_id')->default(0);
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
		Schema::drop('posts');
	}

}
