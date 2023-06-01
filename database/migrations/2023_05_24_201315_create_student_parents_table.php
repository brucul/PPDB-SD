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
        Schema::create('student_parents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('type')->comment('1 = Ayah, 2 = Ibu, 3 = Wali');
            $table->string('name');
            $table->string('pob');
            $table->date('dob');
            $table->string('religion');
            $table->string('last_education');
            $table->string('job');
            $table->bigInteger('monthly_income');
            $table->string('citizenship');
            $table->string('phone');
            $table->text('address');
            $table->integer('is_alive')->default(1)->comment('1 = Ya, 0 = Tidak');
            $table->string('relationship')->nullable();
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
        Schema::dropIfExists('student_parents');
    }
};
