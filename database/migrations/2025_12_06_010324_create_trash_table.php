<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trash', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('original_post_id')->nullable()->comment('Reference to original post ID');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->date('date');
            $table->time('time');
            $table->foreignId('author_id')->constrained('staff')->restrictOnDelete();
            $table->foreignId('photojournalist_id')->nullable()->constrained('staff')->nullOnDelete();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->string('thumbnail')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('deleted_at')->useCurrent()->comment('When moved to trash');
            $table->timestamp('created_at')->nullable()->comment('Original creation date');
            $table->timestamp('updated_at')->nullable()->comment('Original last update');
            
            $table->index('deleted_at');
            $table->index('author_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trash');
    }
};
