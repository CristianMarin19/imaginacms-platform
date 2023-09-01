<?php

use Illuminate\Database\Migrations\Migration;

class AddFulltextIndiceInProductTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \DB::statement('ALTER TABLE icommerce__product_translations ADD FULLTEXT full(name)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
}
