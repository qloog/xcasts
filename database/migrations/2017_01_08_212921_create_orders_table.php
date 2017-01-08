<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');
            $table->float('amount')->default(0)->comment('总金额');
            $table->integer('quantity')->default(0)->comment('购买总数');
            $table->enum('pay_method', ['alipay'])->comment('支付方式');
            $table->tinyInteger('is_paid')->default(0)->comment('是否支付');
            $table->timestamp('paid_at')->default('0')->comment('支付时间');
            $table->enum('status', ['pending','paid_success','paid_fail','cancel'])->default('pending')->comment('支付状态');
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
		Schema::drop('orders');
	}

}
