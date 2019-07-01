<?php

Route::get('/{any}', 'AppController@index')->where('any', '.*');










// Auth::routes();

//customer
// Route::namespace('Customer')->prefix('customer')->name('customer.')->group(function () {

//     Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//     Route::post('login', 'Auth\LoginController@login');
//     Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//     Route::middleware(['auth:customer'])->group(function () {
//         Route::get('/', 'CustomerController@dashboard')->name('dashboard');
//     });
// });




//->name('.customer')->middleware(['auth'])->prefix('customer')
