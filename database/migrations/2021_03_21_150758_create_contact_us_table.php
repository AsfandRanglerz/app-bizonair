<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('inquiry_for')->nullable();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('company')->nullable();
            $table->string('phone')->nullable();
            $table->string('designation')->nullable();
            $table->string('country')->nullable();
            $table->text('description')->nullable();
            $table->string('terms_service')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->default(0)->nullable();
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
        Schema::dropIfExists('contact_us');
    }
}
