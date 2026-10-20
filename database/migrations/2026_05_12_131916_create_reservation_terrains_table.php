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
        Schema::create('reservation_terrains', function (Blueprint $table) {
    $table->id();

    $table->foreignId('reservation_id')
        ->constrained()
        ->onDelete('cascade');

    $table->string('terrain_type'); // inside / outside

    $table->string('name'); // Teren 1

    $table->integer('price');

    $table->string('size')->nullable(); // 45x60m

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_terrains');
    }
};
