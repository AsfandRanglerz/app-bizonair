<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChemicalsProductInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chemicals_product_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id');
            $table->string('manufacturer_company_name')->nullable();
            $table->string('origin')->nullable();
            $table->string('chemicals_listed')->nullable();
            $table->string('supply_type', 15)->nullable();
            $table->string('company_additional_info')->nullable();
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
        Schema::dropIfExists('chemicals_product_infos');
    }
}
