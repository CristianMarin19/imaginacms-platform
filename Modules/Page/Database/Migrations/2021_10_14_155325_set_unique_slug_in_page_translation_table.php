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
        Schema::table('page__page_translations', function (Blueprint $table) {
            $table->string('slug')->index()->change();
            $table->unique(['slug', 'locale'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        //
    }
};
