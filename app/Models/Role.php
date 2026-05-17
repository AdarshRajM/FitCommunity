<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Role extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['role_name'];

    /**
     * Get the users associated with the role.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
