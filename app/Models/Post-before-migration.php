<?php

namespace App\Models;

use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post
{
    public $title;
    public $slug;
    public $excerpt;
    public $date;
    public $body;

    public function __construct($title, $slug, $excerpt, $date, $body)
    {
        $this->title = $title;
        $this->slug = $slug;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
    }

    public static function all()
    {
        return cache()->rememberForever('posts.all', function () {
            return collect(File::files(resource_path('posts')))

                // then map over each item and for each one parse that file into a document
                ->map(fn ($file) => YamlFrontMatter::parseFile($file))

                // once we have a collection of document map over it and build up post obj
                //'$documents' is the result of map over file 
                ->map(fn ($documents) => new Post(
                    $documents->title,
                    $documents->slug,
                    $documents->excerpt,
                    $documents->date,
                    $documents->body()
                ))

                ->sortByDesc('date');
        });
    }

    public static function find($slug)
    {
        // of all the blog posts, find the one with a slug that matches the one that was requested which is the agr of the fn
        return static::all()->firstWhere('slug', $slug);
    }

    public static function findOrFail($slug)
    {
        $post = static::find($slug);

        // if there is no matches slug
        if (!$post) {
            throw new ModelNotFoundException();
        }

        return $post;
    }
}





    // public static function all()
    // {
    //     $files = File::files(resource_path("posts/"));
    //     // 'files' read a directory of files (fetch all files in posts dir)
    //     // 'resource_path' the path of resource directory

    //     // arrow function 
    //     return array_map(fn ($file) => $file->getContents(), $files);

    //     // return array_map( function ($file){
    //     //     return $file->getContents();
    //     // }, $files);
    //     // 'array_map' is a loop return a new array
    //     // 'function($file)' loop over each of the files
    //     // the second arg '$files' is the things you looping over 
    // }

    // public static function find($slug)
    // {
    //     // of all the blog posts, find the one with a slug that matches the one that was requested which is the agr of the fn
    //     $posts = static::all();

    //     $posts->firstWhere('slug', $slug);
    // }


    // public static function find($slug)
    // {
    //     if (!file_exists($path = resource_path("posts/{$slug}.html"))) {
    //         throw new ModelNotFoundException();
    //     }

    //     return cache()->remember("posts.{$slug}", 1200, fn () => file_get_contents($path));
    // }