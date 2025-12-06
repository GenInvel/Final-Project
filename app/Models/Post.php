<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'date',
        'time',
        'author_id',
        'photojournalist_id',
        'category_id',
        'thumbnail',
        'description',
        'image',
        'views',
        'reading_time',
        'is_featured',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
        'is_featured' => 'boolean',
    ];

    // Relationships
    public function author()
    {
        return $this->belongsTo(Staff::class, 'author_id');
    }

    public function photojournalist()
    {
        return $this->belongsTo(Staff::class, 'photojournalist_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    // Helper methods
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : asset('images/default-thumbnail.jpg');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    // Auto-generate slug when creating
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }
}
