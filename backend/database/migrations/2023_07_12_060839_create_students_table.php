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
            $table->unsignedBigInteger('generation_id');
            $table->foreign('generation_id')->references('id')->on('generations')->onDelete('cascade');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
<<<<<<< HEAD:backend/database/migrations/2023_07_12_060839_create_students_table.php
            $table->unsignedBigInteger('generation_id');
            $table->foreign('generation_id')->references('id')->on('generations')->onDelete('cascade');
=======
>>>>>>> c17eda6b0d2b6230b1cf47e28318915eac5872b3:backend/database/migrations/2023_07_04_015829_create_students_table.php
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