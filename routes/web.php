<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MakePostController;
use App\Models\Cattegory;
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
    $post = Post::all();
    return view('posts', ['title' => 'Blog', 'posts'=>$post]);
});

Route::get('/postblog', function () {
    return view('postblog' , ['title' => 'Upload Your blog']);
});
route::get('/authors/{user}', function (User $user) {
    return view('posts', ['title' => Count($user->posts) . ' Article By ' .$user->name, 'posts'=>$user->posts]);
});
route::get('/cattegories/{cattegory}', function (Cattegory $cattegory) {
    return view('posts', ['title' => 'Article in ' .$cattegory->name, 'posts'=>$cattegory->posts]);
});



