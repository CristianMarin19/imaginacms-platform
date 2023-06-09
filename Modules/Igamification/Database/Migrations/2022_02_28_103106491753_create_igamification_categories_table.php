<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIgamificationCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igamification__categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields...
            $table->string('system_name')->unique()->nullable();
            $table->integer('parent_id')->default(0)->nullable();
            $table->text('options')->nullable();

            // Audit fields
            $table->timestamps();
            $table->auditStamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igamification__category_user');
        Schema::dropIfExists('igamification__categories');
    }
}
