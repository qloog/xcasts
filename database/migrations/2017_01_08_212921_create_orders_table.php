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
            $table->integer('id')->unsigned()->comment('订单id');
            $table->decimal('order_amount')->unsigned()->default(0.00)->comment('订单总金额');
            $table->decimal('pay_amount')->unsigned()->default(0.00)->comment('应付总金额');
            $table->integer('quantity')->default(0)->comment('购买总数');
            $table->enum('pay_method', ['alipay'])->comment('支付方式');
            $table->tinyInteger('is_paid')->default(0)->comment('支付状态');
            $table->timestamp('paid_at')->comment('支付时间');
            $table->timestamp('completed_at')->comment('完成时间');
            $table->enum('status', ['pending','paid','canceled','completed'])->default('pending')->comment('订单状态');
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
		Schema::drop('orders');
	}

}
