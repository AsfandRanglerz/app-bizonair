<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Product Info
            $table->unsignedInteger('company_id');
            $table->string('product_service_types', 20);
            $table->unsignedInteger('reference_no')->unique()->from(1000000)->to(9999999);
            $table->string('subject');
            $table->string('keywords');
            $table->string('product_service_name');
            $table->string('product_availability', 15)->nullable();
            $table->text('details')->nullable();
            $table->string('origin')->nullable();
            $table->string('add_sub_sub_category ')->nullable();

            // Trade Info
            $table->string('dealing_as')->nullable();
            $table->string('other_dealing_as')->nullable();
            $table->string('focused_selling_countries')->nullable();
            $table->string('focused_selling_region')->nullable();
            $table->unsignedInteger('production_capacity')->nullable();
            $table->unsignedInteger('min_order_quantity')->nullable();
            $table->boolean('is_sampling')->nullable();
            $table->string('sampling_type', 4)->nullable();
            $table->string('service_types')->nullable();
            $table->string('textile_service_types')->nullable();
            $table->string('service_durations')->nullable();
            $table->string('other_service_duration')->nullable();

            // Payment and delivery info
            $table->string('suitable_currencies')->nullable();
            $table->string('payment_terms')->nullable();
            $table->string('other_payment_term')->nullable();
            $table->time('delivery_time')->nullable();

            $table->string('variation')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->integer('is_certified')->default(0)->nullable();
            $table->integer('is_featured')->default(0)->nullable();
            $table->string('phone')->default(0)->nullable();
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
        Schema::dropIfExists('products');
    }
}
