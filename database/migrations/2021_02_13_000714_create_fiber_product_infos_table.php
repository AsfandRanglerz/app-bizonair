<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiberProductInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiber_product_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id')->unique();
            $table->string('fiber_type')->nullable();
            $table->string('other_fiber_type')->nullable();
            $table->string('size')->nullable();
            $table->string('strength')->nullable();
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
        Schema::dropIfExists('fiber_product_infos');
    }
}
