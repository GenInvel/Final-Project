<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->comment('Format: Last Name, Given Names, Middle Initial');
            $table->string('cspc_email')->unique();
            $table->string('photo')->nullable()->comment('Path to photo');
            $table->enum('position', [
                'Editor-In-Chief',
                'Associate Editor for Internal',
                'Associate Editor for External',
                'Managing Editor',
                'Assistant Managing Editor',
                'Circulation Manager',
                'Copy Editor',
                'Art Editor',
                'Layout Editor',
                'Copyreader',
                'Layout Artist',
                'Editorial Cartoonist',
                'Graphic Artist',
                'Photojournalist',
                'News Presenter',
                'Videographer',
                'Video Editor',
                'Technical Director',
                'Editorial Assistant',
                'News',
                'Opinion',
                'DevCom',
                'Feature',
                'Literary',
                'Sci&Tech',
                'Sports',
            ]);
            $table->string('program', 100);
            $table->string('year_section', 10);
            $table->boolean('is_active')->default(true); // NEW
            $table->enum('status', ['active', 'archived'])->default('active'); // NEW
            $table->timestamp('archived_at')->nullable(); // NEW
            $table->timestamps();
            $table->softDeletes(); // NEW - for soft delete
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
