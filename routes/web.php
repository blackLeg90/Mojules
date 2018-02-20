<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// This applies a permanent redirect until another route is explicitly stated.
//Route::redirect('/', '/projects', 301);

Route::get('/projects', function() {
    return view('welcome');
});

Route::get('/projects/view/{projectName}', function() {
    return view('welcome');
});

Route::get('/link', function() {
    return view('welcome');
});

// These routes refer to functions applied at each controller.
/* Project */
//Route::get('/projects', 'ProjectController@index');
//Route::get('/project/view/{id}', 'ProjectController@view');
//Route::get('/project/create', 'ProjectController@create');
//Route::post('/project/create', 'ProjectController@store');
//Route::get('/project/update/{id}', 'ProjectController@update');
//Route::post('/project/update/{id}', 'ProjectController@store');
//Route::get('/project/delete/{id}', 'ProjectController@delete');
//Route::post('/layouts', 'LayoutController@saveImage');
//Route::delete('/layouts/{id}', 'LayoutController@removeImage');
//
///* Home */
//Route::get('/homes', 'HomeController@index');
//Route::get('/homes/available', 'HomeController@getAvailable');
//Route::patch('/home/layout/{id}', 'HomeController@attachLayout');
//Route::get('/home/view/{id}', 'HomeController@view');
//Route::get('/home/create', 'HomeController@create');
//Route::post('/home/create', 'HomeController@store');
//Route::get('/home/update/{id}', 'HomeController@update');
//Route::post('/home/update/{id}', 'HomeController@store');
//Route::get('/home/delete/{id}', 'HomeController@delete');
//Route::delete('/room/{id}', 'RoomController@delete');
//Route::post('/room/image/{fileName}/{roomId?}', 'RoomController@saveImage');
//Route::delete('/room/image/{fileName}', 'RoomController@removeImage');
//Route::delete('/material/{id}', 'MaterialController@delete');
//Route::post('/images', 'ImageController@saveImage');
//Route::delete('/images/{id}', 'ImageController@removeImage');