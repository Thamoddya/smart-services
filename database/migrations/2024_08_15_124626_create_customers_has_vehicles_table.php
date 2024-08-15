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
        Schema::create('customers_has_vehicles', function (Blueprint $table) {
            $table->unsignedBigInteger('customers_id');
            $table->unsignedBigInteger('vehicles_id');

            $table->primary(['customers_id', 'vehicles_id']);

            $table->foreign('customers_id')
                ->references('id')
                ->on('customers')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('vehicles_id')
                ->references('id')
                ->on('vehicles')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->index('customers_id');
            $table->index('vehicles_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers_has_vehicles');
    }
};
