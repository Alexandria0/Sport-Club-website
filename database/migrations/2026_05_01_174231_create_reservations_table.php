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
          Schema::create('reservations', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('sport');
    $table->string('address');
    $table->text('details')->nullable();
    $table->json('working_days');
    $table->time('start_time');
    $table->time('end_time');
    $table->string('background_image');
    $table->timestamps();
});
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
