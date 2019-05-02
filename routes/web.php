<?php

//Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/', 'Blog\PostController@byCategories')->name('home');

/* Test Roles Route */
/*Route::get('/', function (\Illuminate\Http\Request $request) {
    $user = $request->user();
    $user->givePermissionTo('edit posts', 'delete posts');

    dd($user->can('delete posts'));
})->name('home');*/

/* Test Role and Can (permission) middleware */
Route::get('admin', function () {
})->middleware(['role:admin','can:delete users']);

/* auth routes */
Auth::routes();

Route::namespace('Blog')->prefix('blog')->name('blog.')
    ->group(function () {
        //Route::resource('category', 'CategoryController');
        Route::resource('posts', 'PostController'); //delete

        Route::get('list', 'PostController@byCategories')->name('categories.posts');
        Route::get('category/{slug}', 'PostController@categoryPosts')->name('category.posts');
    });

Route::namespace('Blog\Admin')->prefix('admin/blog')->name('blog.admin.')
    ->group(function () {

        //TODO: use Route::resource() instead;
        Route::name('categories.')->group(function (){
            Route::get('/categories', 'CategoryController@index')->name('index');
            //Route::get('/categories/{category}', 'CategoryController@show')->name('show');
            Route::get('/categories/{category}/edit', 'CategoryController@edit')->name('edit');
            Route::put('/categories', 'CategoryController@store')->name('store');
            Route::get('/categories/create', 'CategoryController@create')->name('create');
            Route::patch('/categories/{category}', 'CategoryController@update')->name('update');
            Route::delete('/categories/{category}', 'CategoryController@destroy')->name('destroy');
            /* Route::resource('categories', 'CategoryController')
                 ->except(['show']);*/
        });

        Route::resource('posts', 'PostController');
    });
