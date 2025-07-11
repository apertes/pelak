<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_hierarchy', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_user_id');
            $table->unsignedBigInteger('child_user_id');
            $table->timestamps();

            $table->foreign('parent_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('child_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['parent_user_id', 'child_user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_hierarchy');
    }
}; 