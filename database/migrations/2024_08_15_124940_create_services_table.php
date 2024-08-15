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
        Schema::create('services', function (Blueprint $table) {
            $table->id(); // equivalent to $table->increments('id')
            $table->string('service_date')->nullable();
            $table->string('service_type')->nullable();
            $table->string('service_details')->nullable();
            $table->string('service_duration')->nullable();
            $table->string('service_technician')->nullable();
            $table->string('full_cost')->nullable();
            $table->string('invoice_number')->nullable();
            $table->unsignedBigInteger('vehicles_id');
            $table->timestamps();

            $table->foreign('vehicles_id')
                ->references('id')
                ->on('vehicles')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->index('vehicles_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
