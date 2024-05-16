<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('c_o_d_s_id');
            $table->date('order_date');
            $table->string('payment_method')->default('cash on delivery');
            $table->enum('payment_status',['pednding','done'])->default('pednding'); 
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->foreign('c_o_d_s_id')->references('id')->on('c_o_d_s')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
