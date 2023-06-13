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
        Schema::create('courses_students', function (Blueprint $table) {
            $table->id();
            $table->string('ADM');
            $table->foreign('ADM')->references('ADM')->on('students')->onDelete('cascade');
            $table->string('code');
            $table->foreign('code')->references('code')->on('courses')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('courses_students', function (Blueprint $table) {
            $table->index('ADM'); 
            $table->index('code'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_students');
    }
};