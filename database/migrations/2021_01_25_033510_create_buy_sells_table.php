<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuySellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_sells', function (Blueprint $table) {
            $table->id();
            // Product Info
            $table->unsignedInteger('user_id');
            $table->string('product_service_types', 20);
            $table->unsignedInteger('reference_no')->unique()->from(1000000)->to(9999999);

            $table->unsignedBigInteger('category_id')->nullable();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedBigInteger('subcategory_id')->nullable();

            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');

            $table->unsignedBigInteger('childsubcategory_id')->nullable();

            $table->foreign('childsubcategory_id')->references('id')->on('childsubcategories')->onDelete('cascade');

            $table->string('subject');
            $table->string('keyword1')->nullable();
            $table->string('keyword2')->nullable();
            $table->string('keyword3')->nullable();
            $table->string('product_service_name');
            $table->string('product_availability', 15)->nullable();
            $table->text('details')->nullable();
            $table->string('origin')->nullable();
            $table->string('add_sub_sub_category')->nullable();
            $table->string('expiry_data')->nullable();
            $table->string('date_expire')->nullable();
            $table->string('price')->nullable();

            // Trade Info
            $table->string('dealing_as')->nullable();
            $table->string('other_dealing_as')->nullable();
            $table->string('focused_selling_countries')->nullable();
            $table->string('focused_selling_region')->nullable();
            $table->unsignedInteger('production_capacity')->nullable();
            $table->unsignedInteger('min_order_quantity')->nullable();
            $table->unsignedInteger('min_order_quantity_unit')->nullable();
            $table->boolean('is_sampling')->nullable();
            $table->string('sampling_type', 4)->nullable();
            $table->string('paid_sampling_price')->nullable();
            $table->string('service_types')->nullable();
            $table->string('textile_service_types')->nullable();
            $table->string('service_durations')->nullable();
            $table->string('other_service_duration')->nullable();

            // Payment and delivery info
            $table->string('suitable_currencies')->nullable();
            $table->string('other_suitable_currency')->nullable();
            $table->string('payment_terms')->nullable();
            $table->string('other_payment_term')->nullable();
            $table->time('delivery_time')->nullable();

            $table->string('slug')->nullable();
            $table->unsignedInteger('createdBy')->nullable();
            $table->unsignedInteger('updatedBy')->nullable();

            $table->string('capacity_unit')->nullable();

            $table->string('product_certification')->nullable();

            $table->string('other_weaving')->nullable();
            $table->string('other_sample_payment')->nullable();

            $table->string('sub_sub_category')->nullable()->change();
            $table->string('delivery_time', 191)->nullable()->change();
            $table->string('delivery')->nullable();
            $table->string('other_target_price_unit')->nullable();
            $table->string('target_price_unit')->nullable();
            $table->string('target_price_to')->nullable();
            $table->string('target_price_from')->nullable();
            $table->string('other_unit_price_unit')->nullable();
            $table->string('unit_price_unit')->nullable();
            $table->string('unit_price_to')->nullable();
            $table->string('unit_price_from')->nullable();

            $table->string('other_weaving_type')->nullable();
            $table->string('available_unit')->nullable();
            $table->string('other_available_unit')->nullable();

            $table->string('variation')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->integer('is_certified')->default(0)->nullable();
            $table->integer('is_featured')->default(0)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('buy_sells');
    }
}
