<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {

            $table->dropColumn([
                'price',
                'terrain_type',
                'terrain_count'
            ]);

        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {

            $table->integer('price')->nullable();

            $table->string('terrain_type')->nullable();

            $table->integer('terrain_count')->default(1);

        });
    }
};