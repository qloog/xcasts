<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function(Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('order_id')->unsigned()->default(0)->comment('订单id');
            $table->integer('item_id')->default(0)->comment('商品id');
            $table->string('name')->default('')->comment('商品名称');
            $table->decimal('price')->unsigned()->default(0.00)->comment('商品价格');
            $table->integer('quantity')->default(0)->comment('购买数量');
            $table->decimal('amount')->unsigned()->default(0.00)->comment('商品总金额');
            $table->integer('user_id')->unsigned()->default(0)->comment('买家uid');
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
        Schema::drop('order_details');
    }
}
