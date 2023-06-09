<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIschedulableDayTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('ischedulable__day_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->string('name');

            $table->integer('day_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['day_id', 'locale']);
            $table->foreign('day_id')->references('id')->on('ischedulable__days')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('ischedulable__day_translations', function (Blueprint $table) {
            $table->dropForeign(['day_id']);
        });
        Schema::dropIfExists('ischedulable__day_translations');
    }
}
