<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // we would only need this if we don't refresh the database at the start  
        // User::truncate();
        // Post::truncate();
        // Category::truncate();


        //we will have a fake data except (user->name) what we merged in
        $user = User::factory()->create([
            'username'=> 'JohnDeo', // not in the course tutorial 
            'name'=> 'John Deo'
        ]);
        Post::factory(10)->create([
            'user_id'  => $user->id
        ]); // will create a corresponding category

        // Post::factory(5)->create(); // will create a corresponding category and a user

        // create 10 users
        // \App\Models\User::factory(10)->create();

        //  create one user
        // $user = User::factory()->create();

        // $personal = Category::create([
        //     'name' => 'Personal',
        //     'slug' => 'personal'
        // ]);

        // $work = Category::create([
        //     'name' => 'Work',
        //     'slug' => 'work'
        // ]);

        // $family = Category::create([
        //     'name' => 'Family',
        //     'slug' => 'family'
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $family->id,
        //     'title' => 'My Family Post',
        //     'slug' => 'my-family-post',
        //     'excerpt' => '<p>Excerpt for my post</p>',
        //     'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Beatae facere error tempora inventore similique aperiam voluptate nisi consequatur, iusto et. Iure, blanditiis omnis? Omnis voluptate vitae quidem quisquam? Error, officiis.</p>',
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $personal->id,
        //     'title' => 'My Personal Post',
        //     'slug' => 'my-personal-post',
        //     'excerpt' => '<p>Excerpt for my post</p>',
        //     'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Beatae facere error tempora inventore similique aperiam voluptate nisi consequatur, iusto et. Iure, blanditiis omnis? Omnis voluptate vitae quidem quisquam? Error, officiis.</p>',
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $work->id,
        //     'title' => 'My Work Post',
        //     'slug' => 'my-work-post',
        //     'excerpt' => '<p>Excerpt for my post</p>',
        //     'body' => '<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Beatae facere error tempora inventore similique aperiam voluptate nisi consequatur, iusto et. Iure, blanditiis omnis? Omnis voluptate vitae quidem quisquam? Error, officiis.</p>',
        // ]);
    }
}
