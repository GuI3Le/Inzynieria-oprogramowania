<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('class_registrations', function (Blueprint $table) {
            // Usuń istniejący klucz obcy
            $table->dropForeign('class_registrations_class_id_foreign');
            
            // Dodaj nowy klucz obcy odnoszący się do fitness_classes
            $table->foreign('fitness_class_id')
                  ->references('id')
                  ->on('fitness_classes')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('class_registrations', function (Blueprint $table) {
            // Usuń nowy klucz obcy
            $table->dropForeign(['fitness_class_id']);
            
            // Przywróć stary klucz obcy
            $table->foreign('fitness_class_id')
                  ->references('id')
                  ->on('classes')
                  ->onDelete('cascade');
        });
    }
};
