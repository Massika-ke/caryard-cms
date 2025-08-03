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
        Schema::create('engines', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedInteger('model_id');
            $table->string('engine_name');
            $table->timestamps();
            $table->foreign('model_id')->references('id')->on('car_models')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('engines');
    }
};
