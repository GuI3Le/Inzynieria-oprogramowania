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
        Schema::table('class_registrations', function (Blueprint $table) {
            $table->renameColumn('class_id', 'fitness_class_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class_registrations', function (Blueprint $table) {
            $table->renameColumn('fitness_class_id', 'class_id');
        });
    }
};
