<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugColoumnInChildsubcategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('childsubcategories', function (Blueprint $table) {
            $table->string('slug')->after('subcategory_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('childsubcategories', function (Blueprint $table) {
            $table->dropColumn('subcategory_id');
        });
    }
}
