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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('branch_name');
            $table->string('location');
            $table->string('contact_no');
            $table->string('email')->nullable();
            $table->string('social_media')->nullable();
            $table->string('vat')->default('no_vat');
            $table->unsignedBigInteger('vat_percent')->nullable();
            $table->string('trn_number')->nullable();
            $table->string('prefix_inv')->nullable();
            $table->string('invoice_header');
            $table->string('image')->nullable();
            $table->date('installation_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
