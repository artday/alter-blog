<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::namespace('Blog')->prefix('blog')->name('blog.')
    ->group(function () {
        //Route::resource('category', 'CategoryController');
        Route::resource('posts', 'PostController');
    });

Route::namespace('Blog\Admin')->prefix('admin/blog')->name('blog.admin.')
    ->group(function () {
        Route::resource('categories', 'CategoryController')
            ->except(['show', 'destroy']);
    });