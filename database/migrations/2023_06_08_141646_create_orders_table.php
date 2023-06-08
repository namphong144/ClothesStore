<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->bigInteger('shipping_id')->unsigned();
            $table->foreign('shipping_id')->references('id')->on('shipping');

            $table->bigInteger('payment_id')->unsigned();
            $table->foreign('payment_id')->references('id')->on('payment');

            $table->string('order_total');
            $table->string('order_status');
            $table->timestamp('buy_at');
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
        Schema::dropIfExists('orders');
    }
};
