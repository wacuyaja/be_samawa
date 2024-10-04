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
        Schema::create('wedding_bonus_package', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wedding_package_id')->references('id')->on('wedding_package')->constrained()->cascadeOnDelete();
            $table->foreignId('bonus_package_id')->references('id')->on('bonus_package')->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wedding_bonus_package');
    }
};
