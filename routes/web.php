<?php

use App\Http\Controllers\PostController;
use App\Models\Category;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index'])->name('home');
// index is the name of action 

Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('categories/{category:slug}', function (Category $category) {

    return view('posts', [
        // 'posts' => $category->posts->load([ 'category', 'author']) // eager load
        'posts' => $category->posts, // no need  to 'load' bcs we set default eager loading in Post model
        'currentCategory' => $category,
        'categories' => Category::all()
    ]);
})->name('category');

Route::get('authors/{author:username}', function (User $author) {

    return view('posts', [
        'posts' => $author->posts->load(['category', 'author']),
        'categories' => Category::all()
    ]);
});





// Route::get('/', function () {
//     return view('posts', [
//         // 'posts' => Post::latest()->with(['category', 'author'])->get() 
//         'posts' => Post::latest()->get(), // no need  to 'with' bcs we set default eager loading in Post model
//         // with: to solve N+1 problem.  latest: order by constrains
//         'categories' => Category::all()
        
//     ]);
// })->name('home');


// Route::get('posts/{post}', function ($id) {
//     // Find a post by its slug and pass it to a view called "post"
//     return view('post', [
//         'post' => Post::findOrFail($id)
//     ]);
// });



// Route::get('/', function () {

//     $files = File::files(resource_path('posts')); // fetch all file in posts dir
//     $posts = []; // array 

//     foreach ($files as $file) {
//         $documents = YamlFrontMatter::parseFile($file);

//         $posts[] = new Post(
//             $documents->title,
//             $documents->excerpt,
//             $documents->date,
//             $documents->body(),
//         );
//     }

//     // ddd($posts);
//     // $document = YamlFrontMatter::parseFile(
//     //     resource_path('posts/my-fourth-post.html')
//     // );
//     // 'parseFile(the path of the file that we want parse)' run file_get_contents() behind the sense

//     // ddd($document->body());
//     // ddd($document->matter());
//     // ddd($document->matter('title'));
//     // ddd($document->title);
//     // ddd($document->excerpt);
//     // ddd($document->date);

//     // $posts = Post::all();
//     // ddd($posts);
//     return view('posts', [
//         'posts' => $posts
//     ]);
// });

// Route::get('/', function () {

//     $files = File::files(resource_path('posts')); // fetch all file in posts dir
//     $posts = []; // array 

//     foreach ($files as $file) {
//         $documents = YamlFrontMatter::parseFile($file);

//         $posts[] = new Post(
//             $documents->title,
//             $documents->slug,
//             $documents->excerpt,
//             $documents->date,
//             $documents->body(),
//         );
//     }

//     return view('posts', [
//         'posts' => $posts
//     ]);
// });

// // clean the above route using 'array_map()'
// Route::get('/', function () {

//     $files = File::files(resource_path('posts')); // fetch all file in posts dir

//     $posts = array_map(function ($file) {
//         $documents = YamlFrontMatter::parseFile($file);

//         return new Post(
//             $documents->title,
//             $documents->slug,
//             $documents->excerpt,
//             $documents->date,
//             $documents->body(),
//         );
//     }, $files);

//     return view('posts', [
//         'posts' => $posts
//     ]);
// });

// // clean the above route using 'Collections'
// Route::get('/', function () {

//     // collect an array and wrap it within a collection object
//     $posts = collect(File::files(resource_path('posts')))   // collects this array of files 
//         // then map over them 
//         ->map(function ($file) {
//             $documents = YamlFrontMatter::parseFile($file);

//             return new Post(
//                 $documents->title,
//                 $documents->slug,
//                 $documents->excerpt,
//                 $documents->date,
//                 $documents->body(),
//             );
//         });

//     return view('posts', [
//         'posts' => $posts
//     ]);
// });

// cleaner way
// Route::get('/', function () {

//     // find all the file in the posts dir and collect them into collection
//     $posts = collect(File::files(resource_path('posts')))

//         // then map over each item and for each one parse that file into a document
//         ->map(fn ($file) => YamlFrontMatter::parseFile($file))

//         // once we have a collection of document map over it and build up post obj
//         //'$documents' is the result of map over file 
//         ->map(fn ($documents) => new Post(
//             $documents->title,
//             $documents->slug,
//             $documents->excerpt,
//             $documents->date,
//             $documents->body()
//         ));

//     return view('posts', [
//         'posts' => $posts
//     ]);
// });


// Route::get('posts/{post}', function ($slug) {
    
//     $path = __DIR__ . "/../resources/posts/{$slug}.html";

//     // ddd($path);

//     if (!file_exists($path)) {
//         // dd('file does not exist');
//         // abort(404); // '404 not found' error page 
//         return redirect('/');  // redirect the user to the home page
//     }

//     // $post = cache()->remember("posts.{$slug}", 1200, function () use ($path) {
//     //     // var_dump('file_get_contents'); // to see when we use this function an when we don't
//     //     return file_get_contents($path);
//     // });

//     // arrow function 
//     $post = cache()->remember("posts.{$slug}", 1200, fn () => file_get_contents($path));

//     // cache()->remember("unique key for that post",
//     //  how long should we cache it(second), (5 or now()->addMinute(20), now()->addHour(), now()->addDay() )
//     //  function(){} );

//     return view('post', [
//         'post' => $post
//     ]);
// })->where('post', '[A-z_\-]+');
// (wildcard) [A-z] mean any letter a to z upper or lower case
// _\- means allow underscore and dash  
// + means one or more of the preceding character

// where('wildcard','');
// ->whereAlpha = [A-z]+
// ->whereAlphaNumeric = [A-z0-9]+
// ->whereNumber = [0-9]+  when use the id