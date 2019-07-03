<?php
// Projects
Route::prefix('projects')->name('projects.')->group(function () {
    Route::get('/', 'ProjectController@index')->name("index");
    Route::post('/', 'ProjectController@store')->name("store");
    Route::get('/{project}', 'ProjectController@show')->name("show");
    Route::put('/{project}', 'ProjectController@update')->name("update");
    Route::delete('/{project}', 'ProjectController@destroy')->name("destroy");
});

// Task
Route::namespace('Task')->prefix('tasks')->name('tasks.')->group(function () {
    Route::get('/tree/{project}', 'TaskController@index')->name("index");
    Route::put('/tree/{project}', 'TaskController@rebuild')->name("rebuild");
    // Task assignee
    Route::prefix('assignee')->name('assignee.')->group(function () {
        Route::delete('/{task}', 'TaskController@removeAssignee')->name("remove");
        Route::post('/{task}', 'TaskController@assign')->name("assign");
    });
    // Task statuses
    Route::prefix('statuses')->name('statuses.')->group(function () {
        Route::get('/', 'TaskStatusController@index')->name("index");
        Route::post('/set/{task}', 'TaskController@setStatus')->name("set");
    });
    Route::get('/{task}', 'TaskController@show')->name("show");
    Route::post('/{project}', 'TaskController@store')->name("store");
    Route::put('/{task}', 'TaskController@update')->name("update");
    Route::delete('/{task}', 'TaskController@destroy')->name("destroy");
});

// Customer
Route::namespace('Customer')->prefix('customers')->name('customers.')->group(function () {
    Route::get('/', 'CustomerController@index')->name("index");
    Route::post('/', 'CustomerController@store')->name("store");
    Route::get('/{customer}', 'CustomerController@show')->name("show");
    Route::put('/{customer}', 'CustomerController@update')->name("update");
    Route::delete('/{customer}', 'CustomerController@destroy')->name("destroy");
});

// Users
Route::namespace('User')->prefix('users')->name('users.')->group(function () {
    Route::get('/', 'UserController@index')->name("index");
    Route::post('/', 'UserController@store')->name("store");
    Route::get('/current', 'UserController@current')->name("current");
    Route::get('/{user}', 'UserController@show')->name("show");
});















//Auth =======================================================================
Route::post('/login', 'AuthController@login')->name('login');
Route::post('/register', 'AuthController@register');
Route::middleware('auth:api')->post('/logout', 'AuthController@logout');


// Route::middleware('auth:customer_api')->get('/customer', function (Request $request) {
//     return "customer";
// });
