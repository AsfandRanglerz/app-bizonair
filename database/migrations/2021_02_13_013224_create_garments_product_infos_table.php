<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarmentsProductInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garments_product_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id')->unique();
            $table->string('material')->nullable();
            $table->string('composition')->nullable();
            $table->string('size_age')->nullable();
            $table->string('color')->nullable();
            $table->string('gender')->nullable();
            $table->string('thickness')->nullable();
            $table->string('brand')->nullable();
            $table->string('design')->nullable();
            $table->string('season')->nullable();
            $table->string('end_use')->nullable();

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
        Schema::dropIfExists('garments_product_infos');
    }
}
