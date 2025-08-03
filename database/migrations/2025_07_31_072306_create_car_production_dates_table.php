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
        Schema::create('car_production_dates', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedInteger('model_id');
            $table->date('created_at');
            $table->foreign('model_id')->references('id')->on('car_models')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_production_dates');
    }
};
