<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugCreatedByUpdatedByToProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->string('slug');
            $table->unsignedInteger('createdBy');
            $table->unsignedInteger('updatedBy')->nullable();
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
            //
             $table->dropColumn('slug');
             $table->dropColumn('createdBy');
             $table->dropColumn('updatedBy');

        });
    }
}
