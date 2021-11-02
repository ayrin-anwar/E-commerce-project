<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_summaries', function (Blueprint $table) {
            $table->id();
            $table->integer('billing_detail_id');
            $table->string('coupon_name')->nullable();
            $table->integer('total');
            $table->integer('discount');
            $table->integer('subtotal');
            $table->integer('shipping');
            $table->integer('payment_status')->default(1)->comment('1=unpaid,2=paid');
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
        Schema::dropIfExists('order_summaries');
    }
}
