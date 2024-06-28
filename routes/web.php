<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

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
    return view('post', ['title' => 'Blog', 'posts'=>$post]);
});

Route::get('/postblog', function () {
    return view('postblog' , ['title' => 'Upload Your blog']);
});


