<?php

Route::prefix('projects')->group(function () {
    Route::name('projects.')->group(function () {
        Route::get('/', 'ProjectController@index')->name("index");
        Route::post('/', 'ProjectController@store')->name("store");
        Route::get('/{project}', 'ProjectController@show')->name("show");
        Route::put('/{project}', 'ProjectController@update')->name("update");
        Route::delete('/{project}', 'ProjectController@destroy')->name("destroy");
    });
    Route::name('tasks.')->group(function () {
        Route::prefix('{project}/tasks')->group(function () {
            Route::get('/', 'TaskController@index')->name("index");
            Route::post('/', 'TaskController@store')->name("store");
            Route::get('/{task}', 'TaskController@show')->name("show");
        });
    });
});

Route::prefix('tasks')->group(function () {
    Route::put('/{task}', 'TaskController@update')->name("update");
    Route::delete('/{task}', 'TaskController@destroy')->name("tasks.destroy");
});



Route::prefix('users')->name('user.')->group(function () {
    Route::get('/', 'UserController@current')->name("current");
    Route::get('/users', 'UserController@index')->name("index");
    Route::get('/{user}', 'UserController@show')->name("show");
});













//Auth =======================================================================
Route::post('/login', 'AuthController@login')->name('login');
Route::post('/register', 'AuthController@register');
Route::middleware('auth:api')->post('/logout', 'AuthController@logout');


// Route::middleware('auth:customer_api')->get('/customer', function (Request $request) {
//     return "customer";
// });
