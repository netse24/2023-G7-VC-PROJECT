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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
<<<<<<< HEAD
            $table->unsignedBigInteger('generation_id');
            $table->foreign('generation_id')->references('id')->on('generations')->onDelete('cascade');
=======
>>>>>>> b10749af28b265a01d7887763a6019bd751a4da7
            $table->timestamps();
        });
    }

    /** */
     /* Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};