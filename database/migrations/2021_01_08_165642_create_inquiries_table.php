<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->nullable();
            $table->bigInteger('buysell_id')->nullable();
            $table->string('product_type')->nullable();
            $table->string('product_service_types')->nullable();
            $table->integer('reference_no')->nullable();
            $table->bigInteger('user_id');
            $table->string('contact_name');
            $table->string('company_name');
            $table->string('contact_no');
            $table->string('email');
            $table->string('country_name');
            $table->string('city');
            $table->text('description');
            $table->string('sample_with_specification_sheet')->nullable();
            $table->string('latest_price_quotation')->nullable();
            $table->string('compliance_certification_required')->nullable();
            $table->string('preferred_payment_terms')->nullable();
            $table->string('production_capacity')->nullable();
            $table->string('qcis')->nullable();
            $table->string('inq_recquirement_name')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('quantity_unit')->nullable();
            $table->string('terms_condition')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('inquiries');
    }
}
