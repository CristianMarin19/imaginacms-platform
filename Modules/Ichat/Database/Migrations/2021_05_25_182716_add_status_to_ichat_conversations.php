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
        Schema::table('ichat__conversations', function (Blueprint $table) {
            $table->integer('status')->unsigned()->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('ichat__conversations', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
    }
};
