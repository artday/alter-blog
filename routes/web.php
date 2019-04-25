<?php

Route::get('/', function () { return view('welcome'); })->name('home');

Auth::routes();

Route::namespace('Blog')->prefix('blog')->name('blog.')
    ->group(function () {
        //Route::resource('category', 'CategoryController');
        Route::resource('posts', 'PostController');

        Route::get('list', 'PostController@byCategories')->name('categories.posts');
        Route::get('category/{slug}', 'PostController@categoryPosts')->name('category.posts');
    });

Route::namespace('Blog\Admin')->prefix('admin/blog')->name('blog.admin.categories.')
    ->group(function () {
        Route::get('/categories', 'CategoryController@index')->name('index');

        //Route::get('/categories/{category}', 'CategoryController@show')->name('show');

        Route::get('/categories/{category}/edit', 'CategoryController@edit')->name('edit');
        Route::put('/categories', 'CategoryController@store')->name('store');
        Route::get('/categories/create', 'CategoryController@create')->name('create');
        Route::patch('/categories/{category}', 'CategoryController@update')->name('update');


       /* Route::resource('categories', 'CategoryController')
            ->except(['show']);*/
    });

//config();