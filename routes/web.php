<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Controllers\Auth\AuthController;
use App\Models\Category;
use App\Models\User;
use Faker\Extension\CountryExtension;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CountViews;
use Illuminate\Foundation\Auth\EmailVerificationRequest;




Route::get('/home', function () {
    return view('home', ['title' => 'Home Page']);
});
route::get('/posts', function () {
    if (request('search')) {
    }
    return view('blog\posts', ['title' => 'Blog', 'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(6)->withquerystring()]);
})->name('posts');
Route::middleware([CountViews::class])->group(function () {
    Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
});
Route::get('/uploadpost', [PostController::class, 'create'])->name('uploadpost')->middleware('auth', 'verified');
Route::post('/uploadpost', [PostController::class, 'store'])->name('post.store');

route::get('/author/{user}', function (User $user) {
    // $posts = $user->posts->load(['author','cattegory']);
    return view('blog\posts', ['title' => Count($user->posts) . ' Article By ' . $user->name, 'posts' => $user->posts]);
});

route::get('/categories/{category:slug}', function (Category $category) {
    return view('blog\posts', ['title' => 'Article in ' . $category->name, 'posts' => $category->posts]);
});
route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'Logout'])->name('logout')->middleware('auth');
route::get('/signup', [SignupController::class, 'index'])->name('signup');
route::post('/signup', [SignupController::class, 'store'])->name('signup.store');

Route::get('/email/verify', function () {
    return view('auth\notice');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');


Route::get('/profile', [ProfileController::class, 'create'])->name('profile');
Route::post('/profile/update-picture', [ProfileController::class, 'update_picture'])->name('picture.update');
Route::post('/profile/delete-picture', [ProfileController::class, 'delete_picture'])->name('picture.delete');
