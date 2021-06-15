<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdColumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('company_id')->nullable()->after('company_name');
            $table->integer('is_admin')->default(0)->after('company_id');
            $table->integer('is_owner')->default(0)->after('is_admin');
            $table->integer('is_member')->default(0)->after('is_owner');
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
            $table->drop('company_id');
            $table->drop('is_owner');
            $table->drop('is_admin');
            $table->drop('is_member');
        });
    }
}
