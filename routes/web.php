<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\User;
use Faker\Extension\CountryExtension;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;



Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});
route::get('/posts', function () {
    if (request('search')) {
    }
    return view('blog\posts', ['title' => 'Blog', 'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(12)->withquerystring()]);
})->name('posts');


Route::get('/uploadpost',[PostController::class, 'create'] )->name('uploadpost')->middleware('auth');
Route::post('/uploadpost', [PostController::class, 'store'])->name('post.store');

route::get('/author/{user}', function (User $user) {
    // $posts = $user->posts->load(['author','cattegory']);
    return view('blog\posts', ['title' => Count($user->posts) . ' Article By ' . $user->name, 'posts' => $user->posts]);
});
route::get('/posts/{post:slug}', function (Post $post) {
    return view('blog\post', ['title' => 'Single Post', 'post' => $post]);
});
route::get('/categories/{category:slug}', function (Category $category) {
    return view('blog\posts', ['title' => 'Article in ' . $category->name, 'posts' => $category->posts]);
});
route::get('/login', [UserController::class, 'LoginForm'])->name('login')->middleware('guest');
route::post('/login', [UserController::class, 'authenticate']);
Route::post('/logout', [UserController::class, 'Logout'])->name('logout')->middleware('auth');
route::get('/signup', [UserController::class, 'SignupForm'])->name('signup');
route::post('/signup', [UserController::class, 'store'])->name('signup.store');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


route::get('/profile', [ProfileController::class, 'create'])->name('profile');

route::post('/profile', [ProfileController::class, 'update_profile'])->name('profile.update');
route::post('/profile', [ProfileController::class, 'delete_profile'])->name('profile.delete');

