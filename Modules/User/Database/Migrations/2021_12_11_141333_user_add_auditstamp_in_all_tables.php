<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserAddAuditstampInAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            //  $table->dropUnique('slug');
            $table->auditStamps();
            $table->unique(['slug', 'organization_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            //  $table->dropUnique('email');
            $table->auditStamps();
            $table->unique(['email', 'organization_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        //
    }
}
