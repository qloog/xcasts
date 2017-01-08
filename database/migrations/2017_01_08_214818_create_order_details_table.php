<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned()->default(0)->comment('订单id');
            $table->string('goods_id')->default(0)->comment('商品id');
            $table->string('goods_name')->default('')->comment('商品名称');
            $table->float('goods_price')->default(0)->comment('商品价格');
            $table->integer('quantity')->default(0)->comment('购买总数');
            $table->timestamp('expire_at')->default('0')->comment('过期时间');
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
