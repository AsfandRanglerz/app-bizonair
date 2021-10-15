<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('table_name');
            $table->string('table_data');
            $table->string('notification_text');
            $table->integer('is_read')->default(0);
            $table->integer('prod_id')->nullable();
            $table->string('product_service_types')->nullable();
            $table->string('product_service_name')->nullable();
            $table->integer('prod_comp_id')->nullable();
            $table->integer('prod_user_id')->nullable();
            $table->integer('is_display')->default(0);
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
        Schema::dropIfExists('notifications');
    }
}
