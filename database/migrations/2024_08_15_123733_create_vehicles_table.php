<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id(); // equivalent to $table->increments('id')
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('service_center_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('vehicle_number')->unique();
            $table->string('vehicle_id')->unique();
            $table->date('last_service_date')->nullable();
            $table->integer('total_servies_count')->nullable();
            $table->integer('last_service_km')->default(0)->nullable();
            $table->integer('next_service_km')->default(0)->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('vehicle_photo')->nullable();
            $table->string('vehicle_video')->nullable();
            $table->string('model_name')->nullable();

            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('service_center_id')
                ->references('id')
                ->on('service_center')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('type_id')
                ->references('id')
                ->on('vehicle_types')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->index('type_id');
            $table->index('service_center_id');
            $table->index('customer_id');
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
