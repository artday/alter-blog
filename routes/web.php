<?php

Route::get('/', function () {
    return view('welcome');
});

/*test route commit*/

Auth::routes();