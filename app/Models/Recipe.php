<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\SoftDeletes;

use MongoDB\Laravel\Eloquent\Model;

class Recipe extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
