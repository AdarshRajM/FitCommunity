<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'tags',
        'status',
        'is_featured',
        'views',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_featured' => 'boolean',
    ];

    /**
     * Return the sluggable configuration array.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the user that owns the blog.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the blog.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * Get the comments for the blog.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get all of the blog's likes.
     */
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Scope a query to only include published blogs.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope a query to only include featured blogs.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
