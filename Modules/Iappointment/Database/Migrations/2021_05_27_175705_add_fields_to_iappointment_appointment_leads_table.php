<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToIappointmentAppointmentLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iappointment__appointment_leads', function (Blueprint $table) {
            $table->dropColumn(['values']);
            $table->string('name')->nullable();
            $table->text('value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iappointment__appointment_leads', function (Blueprint $table) {
            $table->dropColumn(['value', 'name']);
            $table->text('values')->nullable();
        });
    }
}
