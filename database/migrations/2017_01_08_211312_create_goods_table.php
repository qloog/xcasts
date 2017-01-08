<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('goods', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('商品名称');
            $table->string('introduction')->comment('商品介绍');
            $table->float('price')->default(0)->comment('商品价格');
            $table->float('promotion_price')->default(0)->comment('促销价格');
            $table->timestamp('promotion_start')->comment('促销开始时间');
            $table->timestamp('promotion_end')->comment('促销结束时间');
            $table->integer('valid_days')->default(0)->comment('有效天数');
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
		Schema::drop('goods');
	}

}
