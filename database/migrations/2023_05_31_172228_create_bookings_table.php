<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->double('product_price')->nullable();
            $table->double('number_of_guests')->nullable();
            $table->double('tax')->nullable();
            $table->double('platform_charges')->nullable();
            $table->double('total')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('booked_days')->nullable();
            $table->integer('adults')->nullable();
            $table->integer('childs')->nullable();
            $table->integer('infants')->nullable();
            $table->integer('pets')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
