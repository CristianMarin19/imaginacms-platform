<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PageAddExtraFieldsPageTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('page__pages', function (Blueprint $table) {
            $table->string('system_name')->nullable()->after('internal');
            $table->string('type')->nullable()->after('internal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page__pages', function (Blueprint $table) {
            $table->dropColumn(['type', 'system_name']);
        });
    }
}
