<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYarnratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yarnrates', function (Blueprint $table) {
            $table->id();
            $table->string('count');
            $table->string('supplier');
            $table->string('price');
            $table->string('unit')->nullable();
            $table->date('publish_date')->nullable();
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
        Schema::dropIfExists('yarnrates');
    }
}
