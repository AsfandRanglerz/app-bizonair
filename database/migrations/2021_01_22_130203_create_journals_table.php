<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->date('publish_date')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('journal_type_name')->nullable();

//            $table->unsignedBigInteger('cat_id')->nullable();
//            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
//
//            $table->unsignedBigInteger('subcat_id')->nullable();
//            $table->foreign('subcat_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->integer('status')->default(0);

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
        Schema::dropIfExists('journals');
    }
}
