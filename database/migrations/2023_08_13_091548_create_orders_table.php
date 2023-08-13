<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('delivery_method_id')->nullable();
            $table->unsignedBigInteger('shipping_info_id')->nullable();
            $table->unsignedBigInteger('billing_info_id')->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->enum('order_status',['AFS','RFA','DEL']);
            $table->Integer('subtotal')->nullable();
            $table->Integer('shipping_amount')->nullable();
            $table->Integer('total')->nullable();
            $table->text('order_description')->nullable();
            $table->string('payment_status')->default('unpaid');
            $table->string('delivery_note')->nullable();
            $table->string('IP_address')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->dateTime('shipped_at')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
