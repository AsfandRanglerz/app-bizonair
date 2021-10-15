<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFabricProductInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fabric_product_infos', function (Blueprint $table) {
            //
            $table->string('gsm_thickness');
            $table->string('yarn_type');
            $table->string('other_yarn_type');
            $table->string('other_manufacturing_technique');
            $table->string('other_knitting_type');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fabric_product_infos', function (Blueprint $table) {
            //
            $table->dropColumn('other_material_type');
            $table->dropColumn('other_sub_category');
            $table->dropColumn('other_style');
        });
    }
}
