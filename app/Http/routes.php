<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['web']], function() {
    Route::get('/', function () {
        Toastr::success("teste louco");
        return view('welcome');
    });

    Route::auth();

    Route::get('images/{folder}/{filename}', function ($folder, $filename)
    {
        return Image::make(storage_path() . '/images/' . $folder . '/' . $filename)->response();
    });

    Route::get('/home', 'HomeController@index');

    Route::get('/login/{provider?}',[
        'uses' => 'Auth\AuthController@getSocialAuth',
        'as'   => 'auth.getSocialAuth'
    ]);


    Route::get('/login/callback/{provider?}',[
        'uses' => 'Auth\AuthController@getSocialAuthCallback',
        'as'   => 'auth.getSocialAuthCallback'
    ]);

    // Rotas para ver perfis.
    Route::get('/profile', 'ProfileController@index');
    Route::get('/profile/edit', 'ProfileController@edit');
    Route::get('/profile/{user}', 'ProfileController@show');
    Route::post('/profile/{user}', 'ProfileController@dealWithFriendship');
    Route::patch('/profile', 'ProfileController@update');
});

Route::get('asd', function() {
    return Auth::user()->trueFriends()->get();
});