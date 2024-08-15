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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id(); // equivalent to $table->increments('id')
            $table->unsignedBigInteger('type_id');
            $table->string('vehicle_number')->unique();
            $table->dateTime('last_service_date')->nullable();
            $table->integer('total_servies_count')->nullable();
            $table->date('next_service_date')->nullable();
            $table->string('vehicle_photo')->nullable();
            $table->string('vehicle_video')->nullable();
            $table->timestamps();

            $table->foreign('type_id')
                ->references('id')
                ->on('vehicle_types')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->index('type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
