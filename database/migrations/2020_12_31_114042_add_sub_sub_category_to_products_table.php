<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubSubCategoryToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
           $table->unsignedBigInteger('childsubcategory_id')->nullable();

           $table->foreign('childsubcategory_id')->references('id')->on('childsubcategories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
           $table->dropForeign('products_childsubcategory_id_foreign');
        });
    }
}
