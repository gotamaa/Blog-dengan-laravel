<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MakePostController;
use App\Models\Category;
use App\Models\User;
use Faker\Extension\CountryExtension;

Route::resource('posts', MakePostController::class);

Route::get('/', function () {
    return view('home' , ['title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About Me']);
});
Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact Me']);
});
route::get('/posts', function () {
    if(request('search')){
    }
    return view('posts', ['title' => 'Blog', 'posts'=>Post::filter(request(['search','category']))->latest()->get()]);
});

Route::get('/postblog', function () {
    return view('postblog' , ['title' => 'Upload Your blog']);
});
route::get('/authors/{user}', function (User $user) {
    // $posts = $user->posts->load(['author','cattegory']);
    return view('posts', ['title' => Count($user->posts) . ' Article By ' .$user->name, 'posts'=>$user->posts]);
});
route::get('/posts/{post:slug}', function (Post $post){
    return view('post', ['title' => 'Single Post', 'post'=>$post]);
});
route::get('/categories/{category:slug}', function (Category $category) {
    return view('posts', ['title' => 'Article in ' .$category->name, 'posts'=>$category->posts]);
});



