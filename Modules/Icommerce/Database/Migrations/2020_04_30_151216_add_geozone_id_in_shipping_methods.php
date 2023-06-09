<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGeozoneIdInShippingMethods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('icommerce__shipping_methods', function (Blueprint $table) {
            $table->integer('geozone_id')->unsigned()->nullable();
            $table->foreign('geozone_id')->references('id')->on('ilocations__geozones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('icommerce__shipping_methods', function (Blueprint $table) {
            if (Schema::hasColumn('icommerce__shipping_methods', 'geozone_id')) {
                $table->dropForeign('icommerce__shipping_methods_geozone_id_foreign');
                $table->dropColumn('geozone_id');
            }
        });
    }
}
