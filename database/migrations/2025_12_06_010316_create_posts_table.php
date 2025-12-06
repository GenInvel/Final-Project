<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->date('date');
            $table->time('time');
            $table->foreignId('author_id')->constrained('staff')->restrictOnDelete();
            $table->foreignId('photojournalist_id')->nullable()->constrained('staff')->nullOnDelete();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->string('thumbnail')->comment('Path for front view thumbnail');
            $table->longText('description')->comment('The article content itself');
            $table->string('image')->nullable()->comment('Main article image, different from thumbnail');
            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('reading_time')->nullable()->comment('Reading time in minutes');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('slug');
            $table->index('category_id');
            $table->index('author_id');
            $table->index('date');
            $table->index('deleted_at');
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
