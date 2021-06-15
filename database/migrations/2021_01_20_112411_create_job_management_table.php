<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_management', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('designation');
            $table->longtext('job_description')->nullable();
            $table->string('email');
            $table->integer('salary');
            $table->string('job_type')->nullable();
            $table->string('functional_area')->nullable();
            $table->string('textile_sector')->nullable();
            $table->string('salary_unit')->nullable();
            $table->string('job_level')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->integer('work_hour')->nullable();
            $table->string('qualification');
            $table->string('skills');
            $table->integer('work_experience')->nullable();
            $table->integer('vacancies')->nullable();
            $table->date('closing_date')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('job_management');

    }
}
