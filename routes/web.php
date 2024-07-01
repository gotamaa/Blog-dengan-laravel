<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MakePostController;

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
    $post = Post::all();
    return view('posts', ['title' => 'Blog', 'posts'=>$post]);
});

Route::get('/postblog', function () {
    return view('postblog' , ['title' => 'Upload Your blog']);
});


