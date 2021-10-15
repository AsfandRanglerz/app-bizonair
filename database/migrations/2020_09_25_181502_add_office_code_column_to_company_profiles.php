<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOfficeCodeColumnToCompanyProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_profiles', function (Blueprint $table) {
            $table->string('office_code')->nullable()->after('company_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_profiles', function (Blueprint $table) {
            $table->drop('office_code');
        });
    }
}
