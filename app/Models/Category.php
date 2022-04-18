<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Eloquent relationship
    public function posts()
    {
        // category has many posts
        return $this->hasMany(Post::class);
    }
}
