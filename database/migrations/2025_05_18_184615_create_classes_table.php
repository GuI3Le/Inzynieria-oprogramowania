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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->text('description');
            $table->integer('available_spots');
            $table->foreignId('employee_id')->constrained();
            $table->timestamp('scheduled_time');
            $table->timestamps();
        });

        Schema::create('class_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('class_id')->constrained();
            $table->string('status',50);
            $table->timestamp('registration_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
