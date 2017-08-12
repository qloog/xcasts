<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['video', 'blog'])->comment('评论所属类型');
            $table->integer('related_id')->default(0)->comment('关联id');
            $table->string('ip', 15)->default('')->comment('评论者所在地ip');
            $table->text('content')->comment('markdown评论内容');
            $table->text('origin_content')->comment('原始评论内容');
            $table->integer('up_count')->commnet('赞数量');
            $table->integer('user_id')->default(0)->comment('评论者id');
            $table->string('device_type')->default('')->comment('客户端设备类型');
            $table->softDeletes();
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
		Schema::drop('comments');
	}

}
