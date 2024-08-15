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
        Schema::create('service_center', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->integer('total_access_vehicles')->default(0);
            $table->unsignedBigInteger('users_id');
            $table->timestamps();

            $table->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->index('users_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_center');
    }
};
