<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYarnProductInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yarn_product_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id')->unique();
            $table->string('attribute')->nullable();
            $table->string('technology')->nullable();
            $table->unsignedTinyInteger('count')->nullable();
            $table->string('count_type', 10)->nullable();
            $table->string('grade')->nullable();
            $table->string('yarn_specialty', 15)->nullable();
            $table->string('tenacity')->nullable();
            $table->string('tpi')->nullable();
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
        Schema::dropIfExists('yarn_product_infos');
    }
}
