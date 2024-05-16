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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('Product_Name');
            $table->string('description');
            $table->string('image');
            $table->double('price');
            $table->double('size');
            $table->integer('quantity');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categores')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
