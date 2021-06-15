<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class vingCreateFabricProductInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fabric_product_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id')->unique();
            $table->string('fabric_construction')->nullable();
            $table->string('fabric_types')->nullable();
            $table->string('other_fabric_type')->nullable();
            $table->string('weave_types')->nullable();
            $table->string('other_weave_type')->nullable();
            $table->string('non_woven_types')->nullable();
            $table->string('other_non_woven_type')->nullable();
            $table->string('width_from')->nullable();
            $table->string('width_to')->nullable();
            $table->string('fabric_composition')->nullable();
            $table->string('manufacturing_technique')->nullable();
            $table->string('knitting_type')->nullable();
            $table->string('features')->nullable();
            $table->string('other_feature')->nullable();
            $table->string('uses')->nullable();
            $table->string('other_use')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fabric_product_infos');
    }
}
