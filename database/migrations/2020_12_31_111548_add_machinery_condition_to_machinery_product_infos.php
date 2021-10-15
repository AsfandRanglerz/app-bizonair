<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMachineryConditionToMachineryProductInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('machinery_product_infos', function (Blueprint $table) {
            $table->string('machinery_condition')->nullable()->after('service_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('machinery_product_infos', function (Blueprint $table) {
            $table->dropColumn('machinery_condition');
        });
    }
}
