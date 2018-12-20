<?php

//Auth
Route::get('/welcome', 'AuthController@index');
Route::post('/signin', 'AuthController@signIn')->name('signIn');
Route::get('/logout', 'AuthController@logOut')->name('logOut');

//Registration
Route::get('/signup', 'AuthController@getSignUp')->name('signUp');
Route::post('/signup', 'AuthController@signUp')->name('storeUser');
Route::get('/user/verify/{token}', 'AuthController@verifyUser');

//Users
Route::get('/user/{user}', 'UserController@show');
Route::get('/user/{user}/show', 'UserController@showUpdate');
Route::post('/user/{user}/edit', 'UserController@edit');
Route::post('/user/{user}/follow', 'UserController@follow');
Route::post('/user/{user}/unfollow', 'UserController@unfollow');

//Posts
Route::get('/home', 'PostController@index');
Route::post('/posts/create', 'PostController@create')->name('createPost');
Route::delete('/posts/{post}', 'PostController@destroy');

//Comments and Likes
Route::post('/comments/create', 'CommentController@create');
Route::post('/comments/createReply', 'CommentController@createReply');
Route::get('/comments', 'CommentController@show');
Route::post('/likes/create', 'PostController@like');
Route::post('/likes/destroy', 'PostController@unlike');


