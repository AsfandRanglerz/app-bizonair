<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriorityColoumnInSubServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subservices', function (Blueprint $table) {
            $table->integer('priority')->default(0)->after('mainservice_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subservices', function (Blueprint $table) {
            $table->dropColumn('priority');
        });
    }
}
