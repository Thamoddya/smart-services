<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('our_services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name');
            //service center id
            $table->unsignedBigInteger('service_centers_id');
            $table->timestamps();

            $table->foreign('service_centers_id')
                ->references('id')
                ->on('service_center')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->index('service_centers_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('our_services');
    }
};
