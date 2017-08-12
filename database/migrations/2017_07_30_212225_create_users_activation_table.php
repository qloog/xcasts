<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersActivationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_activations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('token');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('users', function (Blueprint $table) {
           $table->boolean('is_activated')->comment('是否激活 1:是 0:否');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_activations');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_activated');
        });
    }
}
