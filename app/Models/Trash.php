<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trash extends Model
{
    use HasFactory;

    protected $table = 'trash';

    protected $fillable = [
        'original_post_id',
        'title',
        'slug',
        'date',
        'time',
        'author_id',
        'photojournalist_id',
        'category_id',
        'thumbnail',
        'description',
        'reading_time',
        'article_image',
    ];

    public function author()
    {
        return $this->belongsTo(Staff::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function photojournalist()
    {
        return $this->belongsTo(Staff::class, 'photojournalist_id');
    }
}
