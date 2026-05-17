<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Get the blogs for the category.
     */
    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * Get the posts for the category.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}