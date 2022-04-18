<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    //action
    public function index()
    {
        return view('posts', [
            // 'posts' => $this->getPosts(),
            'posts' => Post::latest()->filter(request(['search']))->get(),
            'categories' => Category::all()

        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            'post' => $post
        ]);
    }

    //search 
    // protected function getPosts()
    // {
    //     return Post::latest()->filter()->get();
    //     // 'filter' filter the post according to what the user search for
    //     // (filter) create your own query scopes directly on eloquent model 

        
    //     // $post = Post::latest();
    //     // if (request('search')) {
    //     //     $post->where('title', 'like', '%' . request('search') . '%')
    //     //         ->orWhere('title', 'like', '%' . request('search') . '%');
    //     // }
    //     // return $post->get();
    // }
}
