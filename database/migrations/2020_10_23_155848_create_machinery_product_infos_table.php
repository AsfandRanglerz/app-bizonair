<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineryProductInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machinery_product_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id')->unique();
            $table->string('product_type', 10)->nullable();
            $table->string('after_sales_service', 35)->nullable();
            $table->string('service_type')->nullable();
            $table->string('warranty', 35)->nullable();
            $table->string('warranty_period')->nullable();
            $table->string('certification', 35)->nullable();
            $table->string('certification_details')->nullable();
            $table->string('additional_trade_notes')->nullable();
            $table->string('product_related_certifications')->nullable();
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
        Schema::dropIfExists('machinery_product_infos');
    }
}
