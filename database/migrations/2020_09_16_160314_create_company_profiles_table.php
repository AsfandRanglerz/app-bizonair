<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('company_name');
            $table->string('business_type');
            $table->string('other_business_type')->nullable();
            $table->string('business_nature')->nullable();
            $table->string('registeration_no')->nullable();
            $table->string('year_established')->nullable();
            $table->string('no_of_employees')->nullable();
            $table->string('annual_turnover')->nullable();
            $table->string('export_market')->nullable();
            $table->string('certifications')->nullable();
            $table->string('logo')->nullable();
            $table->string('company_images')->nullable();
            $table->text('company_introduction')->nullable();
            $table->string('business_owner')->nullable();
            $table->string('alternate_contact')->nullable();
            $table->string('alternate_email')->nullable();
            $table->string('alternate_address')->nullable();
            $table->softDeletes();
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
        Schema::dropForeign('company_profiles_user_id_foreign');
        Schema::dropIfExists('company_profiles');
    }
}
