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
        Schema::create('wedding_transaction', function (Blueprint $table) {
            $table->id();
            $table->string('booking_trx_id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('proof');
            $table->unsignedBigInteger('total_amount');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('total_tax_amount');
            $table->boolean('is_paid');
            $table->date('started_at');
            $table->foreignId('wedding_package_id')->references('id')->on('wedding_package')->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wedding_transaction');
    }
};
