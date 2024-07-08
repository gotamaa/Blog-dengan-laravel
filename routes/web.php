<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\User;
use Faker\Extension\CountryExtension;
use App\Http\Controllers;

Route::resource('post', PostController::class);

Route::get('/', function () {
    return view('home' , ['title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About Me']);
})->name('about');
Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact Me']);
})->name('contact');
route::get('/posts', function () {
    if(request('search')){
    }
    return view('blog\posts', ['title' => 'Blog', 'posts'=>Post::filter(request(['search','category','author']))->latest()->get()]);
})->name('posts');

Route::get('/postarticle', function (Category $categories) {
    return view('createpost' , ['title' => 'Upload Your blog']);
});
route::get('/author/{user}', function (User $user) {
    // $posts = $user->posts->load(['author','cattegory']);
    return view('blog\posts', ['title' => Count($user->posts) . ' Article By ' .$user->name, 'posts'=>$user->posts]);
});
route::get('/posts/{post:slug}', function (Post $post){
    return view('blog\post', ['title' => 'Single Post', 'post'=>$post]);
});
route::get('/categories/{category:slug}', function (Category $category) {
    return view('blog\posts', ['title' => 'Article in ' .$category->name, 'posts'=>$category->posts]);
});
route::get('/login' , [Controllers\LoginController::class, 'LoginForm'])->name('login')->middleware('auth');
route::post('/login' , [Controllers\LoginController::class, 'authenticate']);



