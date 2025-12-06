<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'staff';

    protected $fillable = [
        'full_name',
        'cspc_email',
        'photo',
        'position',
        'program',
        'year_section',
        'is_active',
        'status',
        'archived_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'archived_at' => 'datetime',
    ];

    // Relationships
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function photojournalistPosts()
    {
        return $this->hasMany(Post::class, 'photojournalist_id');
    }

    public function drafts()
    {
        return $this->hasMany(Draft::class, 'author_id');
    }

    public function trashedPosts()
    {
        return $this->hasMany(Trash::class, 'author_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->where('status', 'active');
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    public function scopeEditorialBoard($query)
    {
        $editorialPositions = [
            'Editor-In-Chief',
            'Associate Editor for Internal',
            'Associate Editor for External',
            'Managing Editor',
            'Assistant Managing Editor',
            'Circulation Manager',
            'Copy Editor',
            'Art Editor',
            'Layout Editor'
        ];
        
        return $query->whereIn('position', $editorialPositions);
    }

    // Helper methods
    public function isEditorialBoard()
    {
        $editorialPositions = [
            'Editor-In-Chief',
            'Associate Editor for Internal',
            'Associate Editor for External',
            'Managing Editor',
            'Assistant Managing Editor',
            'Circulation Manager',
            'Copy Editor',
            'Art Editor',
            'Layout Editor'
        ];
        
        return in_array($this->position, $editorialPositions);
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : asset('images/avatar.jpg');
    }

    // Accessor methods for backward compatibility
    public function getNameAttribute()
    {
        return $this->full_name;
    }

    public function getEmailAttribute()
    {
        return $this->cspc_email;
    }

    public function getPictureAttribute()
    {
        return $this->photo;
    }

    // Archive method
    public function archive()
    {
        $this->update([
            'is_active' => false,
            'status' => 'archived',
            'archived_at' => now(),
        ]);
    }

    // Restore from archive
    public function unarchive()
    {
        $this->update([
            'is_active' => true,
            'status' => 'active',
            'archived_at' => null,
        ]);
    }
}
