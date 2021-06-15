<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToYarnProductInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('yarn_product_infos', function (Blueprint $table) {
            $table->string('other_end_use')->nullable()->after('purpose');
            $table->string('other_count_type')->nullable()->after('purpose');
            $table->string('other_speciality')->nullable()->after('purpose');
            $table->string('other_count_unit')->nullable()->after('purpose');
            $table->string('other_attribute')->nullable()->after('purpose');
            $table->string('other_technology')->nullable()->after('purpose');
            $table->string('variety')->nullable()->after('purpose');
            $table->string('count_unit')->nullable()->after('count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('yarn_product_infos', function (Blueprint $table) {
            $table->dropColumn('denier_filament_to');
            $table->dropColumn('denier_filament_from');
            $table->dropColumn('product_grade');
            $table->dropColumn('product_range');
            $table->dropColumn('quality_range');
            $table->dropColumn('variety');
            $table->dropColumn('count_unit');
        });
    }
}
