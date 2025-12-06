<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trash', function (Blueprint $table) {
            if (!Schema::hasColumn('trash', 'reading_time')) {
                $table->integer('reading_time')->nullable()->after('description');
            }
            if (!Schema::hasColumn('trash', 'article_image')) {
                $table->string('article_image')->nullable()->after('thumbnail');
            }
        });
    }

    public function down(): void
    {
        Schema::table('trash', function (Blueprint $table) {
            $table->dropColumn(['reading_time', 'article_image']);
        });
    }
};
