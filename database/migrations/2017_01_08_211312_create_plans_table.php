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
		Schema::create('plans', function(Blueprint $table) {
            $table->increments('id');
            $table->string('alias')->comment('别名');
            $table->string('name')->comment('名称');
            $table->string('description')->comment('描述');
            $table->decimal('price')->unsigned()->default(0.00)->comment('价格');
            $table->decimal('promo_price')->unsigned()->default(0.00)->comment('促销价格');
            $table->timestamp('promo_start')->default('0000-00-00 00:00:00')->comment('促销开始时间');
            $table->timestamp('promo_end')->default('0000-00-00 00:00:00')->comment('促销结束时间');
            $table->integer('valid_days')->unsigned()->default(0)->comment('有效天数');
            $table->tinyInteger('status')->unsigned()->default(0)->comment('状态 1:正常 0:默认');
            $table->tinyInteger('user_id')->unsigned()->default(0)->comment('买家uid');
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
		Schema::drop('plans');
	}

}
