<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade')->onUpdate('cascade');
            $table->text('birth_certificate');
            $table->text('family_certificate');
            $table->text('kindergarten_certificate')->nullable();
            $table->text('kip')->nullable();
            $table->text('kps')->nullable();
            $table->text('bpjs')->nullable();
            $table->text('mother_id');
            $table->text('father_id');
            $table->text('kia');
            $table->text('student_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
