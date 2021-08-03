<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadCvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_cvs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('phone_code')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('email')->nullable();
            $table->string('total_experience')->nullable();
            $table->string('edu_level')->nullable();
            $table->string('functional_area')->nullable();
            $table->string('textile_sector')->nullable();
            $table->integer('exp_salary')->nullable();
            $table->string('sal_unit')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('key_skills')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('upload_cvs');
    }
}
