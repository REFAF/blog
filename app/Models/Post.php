<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Post extends Model
{
    use HasFactory;


    // protected $fillable = ['title', 'excerpt', 'body'];
    // protected $guarded = ['id'];
    protected $guarded = [];

    // Eager loading by default
    // give me a post with these default relationship
    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters) // Post::newQuery()->filter() "just call the part after 'scope'
    {
        // $query is pass by laravel automatically
        // "Post::newQuery()->filter()" is identical to "Post::newQuery()->where('',''....)" 
        // so we can instead throw all of that into a dedicated query scope


        // "when" apply the callback's query changes if the given "value" is true
        // ?? Null coalescing
        // if the value of "$filters['search']" does not exist take the value "false" 
        $query->when($filters['search'] ?? false, fn ($query, $search) => 
            $query
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%'));
    }

    // public function getRouteKeyName()
    // {
    //     //    return parent::getRouteKeyName(); // TODO: change the autogenerated stub
    //     return 'slug';
    // }

    // Eloquent relationship
    public function category()
    {
        // Relationships:  hasOne, hasMany, belongsTo, belongsToMany

        // post belongs to category

        //  return a call to the relationship
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
