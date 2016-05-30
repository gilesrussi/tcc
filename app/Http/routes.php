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
        if(Auth::guest()) {
            return view('welcome');
        } else {
            return redirect()->action('HomeController@index');
        }
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

    //Rotas para Turma :D
    Route::group(['prefix' => 'turma'], function() {
        Route::get('/', 'TurmaController@index');
        Route::get('/find', 'TurmaController@find');
        Route::get('/search', 'TurmaController@search');
        Route::post('/create', 'TurmaController@create');
        Route::get('/create', 'TurmaController@create');
        Route::post('/store', 'TurmaController@store');
        Route::get('/{turma}', 'TurmaController@show');
        Route::post('/{turma}/join', 'TurmaController@join');

        Route::post('/', 'TurmaController@store');

    });

    //Rotas para profile
    Route::group(['prefix' => 'profile'] , function() {
        Route::get('/', 'ProfileController@index');
        Route::get('/edit', 'ProfileController@edit');
        Route::get('/{user}', 'ProfileController@show');
        Route::post('/{user}', 'ProfileController@dealWithFriendship');
        Route::patch('/', 'ProfileController@update');
    });
});

Route::get('asd', function() {
    
});