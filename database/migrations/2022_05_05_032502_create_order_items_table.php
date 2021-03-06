<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inventorie_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('order_item_status_code_id');
            $table->integer('quantity');
            $table->float('price');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('inventorie_id')->references('id')->on('inventories');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('order_item_status_code_id')->references('id')->on('order_item_status_codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
