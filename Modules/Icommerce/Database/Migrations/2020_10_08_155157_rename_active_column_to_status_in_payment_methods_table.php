<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameActiveColumnToStatusInPaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            Schema::table('icommerce__payment_methods', function (Blueprint $table) {
                $table->renameColumn('active', 'status');
            });
        } catch(\Exception $e) {
            \Log::info(" There is no column with name 'status' on table 'icommerce__payment_methods'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
}
