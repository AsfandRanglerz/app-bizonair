<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMyAccountColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->nullable()->after('last_name');
            $table->string('designation')->nullable()->after('company_name');
            $table->string('state')->nullable()->after('country_id');
            $table->string('city')->nullable()->after('state');
            $table->string('street_address')->nullable()->after('city');
            $table->string('phone_no')->nullable()->after('street_address');
            $table->string('whatsapp_number')->nullable()->after('phone_no');
            $table->string('telephone')->nullable()->after('whatsapp_number');
            $table->string('fax')->nullable()->after('telephone');
            $table->string('postcode')->nullable()->after('fax');
            $table->string('website')->nullable()->after('postcode');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->drop('postcode');
            $table->drop('website');
            $table->drop('fax');
            $table->drop('telephone');
            $table->drop('whatsapp_number');
            $table->drop('phone_no');
            $table->drop('street_address');
            $table->drop('city');
            $table->drop('state');
            $table->drop('designation');
            $table->drop('gender');
        });
    }
}
