<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitTargetDeliveryColumnsToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('delivery')->nullable()->after('delivery_time');
            $table->string('other_target_price_unit')->nullable()->after('delivery_time');
            $table->string('target_price_unit')->nullable()->after('delivery_time');
            $table->string('target_price_to')->nullable()->after('delivery_time');
            $table->string('target_price_from')->nullable()->after('delivery_time');
            $table->string('other_unit_price_unit')->nullable()->after('delivery_time');
            $table->string('unit_price_unit')->nullable()->after('delivery_time');
            $table->string('unit_price_to')->nullable()->after('delivery_time');
            $table->string('unit_price_from')->nullable()->after('delivery_time');
            $table->string('other_suitable_currency')->nullable()->after('suitable_currencies');
            $table->string('sub_sub_category')->nullable()->change();
            $table->string('delivery_time', 191)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void2
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('target_price_unit');
            $table->dropColumn('target_price_to');
            $table->dropColumn('target_price_from');
            $table->dropColumn('unit_price_unit');
            $table->dropColumn('unit_price_to');
            $table->dropColumn('unit_price_from');
            $table->dropColumn('delivery');
            $table->dropColumn('other_suitable_currency');
            $table->dropColumn('other_unit_price_unit');
            $table->dropColumn('other_target_price_unit');
        });
    }
}
