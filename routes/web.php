<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::namespace('Blog')->prefix('blog')->name('blog.')
    ->group(function () {
        Route::resource('category', 'CategoryController');
        Route::resource('post', 'PostController');
    });