<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'image',
        'video',
        'hashtags',
        'is_published',
        'is_approved',
        'views',
    ];

    protected $casts = [
        'hashtags' => 'array',
        'is_published' => 'boolean',
        'is_approved' => 'boolean',
    ];

    /**
     * Get the user that owns the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the post.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    /**
     * Get the comments for the post.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get all of the post's likes.
     */
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Check if the post is liked by a user.
     */
    public function isLikedBy(User $user): bool
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    /**
     * Get the comment count.
     */
    public function getCommentCountAttribute(): int
    {
        return $this->comments()->count();
    }

    /**
     * Get the like count.
     */
    public function getLikeCountAttribute(): int
    {
        return $this->likes()->count();
    }
}
