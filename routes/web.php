<?php

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
    return view('posts', ['title' => 'Blog', 'posts'=>[
        [
        'title'=> 'Hari pertama',
        'author'=>'I Made Arudea Deniafinder Gotama',
        'body'=>'Instalasi laragon dan mempelajari struktur folder laravel'
        ],
        [
        'title'=> 'Hari kedua',
        'author'=>'I Made Arudea Deniafinder Gotama',
        'body'=>'Mempejari Blade Component'
        ],
        [
        'title'=> 'Hari ketiga',
        'author'=>'I Made Arudea Deniafinder Gotama',
        'body'=>'?'
        ],
        ]
    ]);
});


