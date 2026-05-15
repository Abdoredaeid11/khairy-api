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
        Schema::table('fatwas', function (Blueprint $table) {
            $table->index('type');
            $table->index('is_published');
            $table->fullText(['title', 'content']); // للبحث النصي السريع
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fatwas', function (Blueprint $table) {
            $table->dropIndex(['type']);
            $table->dropIndex(['is_published']);
            $table->dropFullText(['title', 'content']);
        });
    }
};
