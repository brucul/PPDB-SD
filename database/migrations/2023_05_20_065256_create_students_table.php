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
        Schema::disableForeignKeyConstraints();
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number');
            $table->integer('type')->comment('1 = Zonasi, 2 = Prestasi');
            $table->integer('status')->default(0)->comment('1 = Lolos, 2 = Tidak Lolos');
            $table->string('fullname');
            $table->string('nickname');
            $table->integer('gender')->comment('1 = Laki-laki, 2 = Perempuan');
            $table->string('pob');
            $table->date('dob');
            $table->string('religion');
            $table->string('citizenship');
            $table->integer('birth_order');
            $table->integer('total_sibling')->default(0)->nullable();
            $table->integer('total_step_sibling')->default(0)->nullable();
            $table->integer('total_foster_sibling')->default(0)->nullable();
            $table->string('language');
            $table->string('address');
            $table->string('phone');
            $table->string('residence')->comment('1 = Orang tua, 2 = Menumpang pada orang lain, 3 = Asrama');
            $table->bigInteger('distance_in_meters')->default(0);
            $table->string('transportation')->comment('1 = Kendaraan Umum, 2 = Kendaraan Pribadi, 3 = Jalan Kaki');
            $table->bigInteger('distance_in_minutes')->default(0);
            $table->integer('weight_in_kg')->default(0)->nullable();
            $table->integer('height_in_cm')->default(0)->nullable();
            $table->string('blood_type')->nullable();
            $table->text('disease_history')->nullable();
            $table->string('kindergarten_name')->nullable();
            $table->string('kindergarten_address')->nullable();
            $table->string('certificate_number')->nullable();
            $table->integer('long_study')->nullable();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('students');
        Schema::enableForeignKeyConstraints();
    }
};
