<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('iprofile__addresses', function (Blueprint $table) {
            $table->string('telephone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('iprofile__addresses', function ($table) {
            $table->dropColumn('telephone');
        });
    }
};
