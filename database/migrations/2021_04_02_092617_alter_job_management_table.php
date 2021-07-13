<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterJobManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_management', function (Blueprint $table) {
            $table->string('gender')->nullable();
            $table->string('company')->nullable();
            $table->string('other_company')->nullable();
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_management', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('company');
            $table->dropColumn('image');
        });
    }
}
