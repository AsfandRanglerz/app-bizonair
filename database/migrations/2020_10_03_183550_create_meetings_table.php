<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->nullable();
            $table->string('title')->nullable();
            $table->string('meeting_date')->nullable();
            $table->string('meeting_time')->nullable();
            $table->text('detail')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('is_read')->default(0);
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
        Schema::dropIfExists('meetings');
    }
}
