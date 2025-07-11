<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // حذف auto-increment از فیلد id
        DB::statement('ALTER TABLE planted_trees MODIFY id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE planted_trees AUTO_INCREMENT = 1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // برگرداندن auto-increment
        DB::statement('ALTER TABLE planted_trees MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
    }
};
