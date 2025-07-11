<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('planted_trees', function (Blueprint $table) {
            // تغییر فیلد qr_code به nullable
            $table->string('qr_code')->nullable()->change();
            // اضافه کردن فیلد qr_image
            $table->string('qr_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('planted_trees', function (Blueprint $table) {
            // برگرداندن تغییرات
            $table->string('qr_code')->nullable(false)->change();
            $table->dropColumn('qr_image');
        });
    }
};
