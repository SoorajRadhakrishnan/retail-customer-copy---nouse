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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('unit_id');
            $table->string('item_name');
            $table->string('item_other_name')->nullable();
            $table->string('item_cost_price')->nullable();
            $table->enum('multiple_price',['yes','no'])->default('no');
            $table->string('item_price');
            $table->string('barcode');
            $table->unsignedBigInteger('stock')->nullable();
            $table->enum('item_type',['1','0'])->default('1');
            $table->enum('stock_applicable',['1','0'])->default('1');
            $table->string('image')->nullable();
            $table->date('expiry_date');
            $table->enum('active',['yes','no'])->default('yes');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
