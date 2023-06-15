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
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->string('ADM');
            $table->foreign('ADM')->references('ADM')->on('students')->onDelete('cascade');
            $table->string('code');
            $table->foreign('code')->references('code')->on('units')->onDelete('cascade');
            $table->string('cat1')->nullable();
            $table->string('cat2')->nullable();
            $table->string('exam')->nullable();
            $table->string('marks')->nullable();
            $table->string('grade')->nullable();
            $table->timestamps();
        });

        Schema::table('marks', function (Blueprint $table) {
            $table->index('ADM'); 
            $table->index('code'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};
