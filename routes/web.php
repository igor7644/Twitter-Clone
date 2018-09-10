<?php

Route::get('/welcome', 'PagesController@getIndex');

//Auth
Route::post('/signin', 'AuthController@signIn')->name('signIn');
Route::get('/logout', 'AuthController@logOut')->name('logOut');

//Registration
Route::get('/signup', 'PagesController@getSignUp')->name('signUp');
Route::post('/signup', 'AuthController@signUp')->name('storeUser');
Route::get('/user/verify/{token}', 'AuthController@verifyUser');

Route::get('/home', 'PostController@index');
Route::post('/home/create', 'PostController@create');

Route::post('/comments/create', 'CommentController@create');
Route::get('/comments', 'CommentController@show');


