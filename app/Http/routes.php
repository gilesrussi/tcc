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

    Route::get('/instituicao/{instituicao}', 'InstituicaoController@show');
    Route::get('/curso/{curso}', 'CursoController@show');
    Route::get('/disciplina/{disciplina}', 'DisciplinaController@show');

    Route::get('images/{folder}/{filename}', function ($folder, $filename)
    {
        return Image::make(storage_path() . '/images/' . $folder . '/' . $filename)->response();
    });

    Route::get('/home', 'HomeController@index');

    Route::get('/notificacoes', 'NotificacaoController@index');

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
        Route::post('/', 'TurmaController@store');
        Route::get('/{turma}', 'TurmaController@show');
        Route::any('/{turma}/join', 'TurmaController@join');
        Route::get('{turma}/leave', 'TurmaController@leave');
        Route::post('/', 'TurmaController@store');
        Route::get('/{turma}/colegas', 'TurmaController@classmates');
        Route::get('/{turma}/convidar', 'TurmaController@invite');
        Route::get('/{turma}/convidar/{user}', 'TurmaController@inviteFriend');

        Route::group(['prefix' => '{turma}/material'], function() {
            Route::get('/', 'MaterialController@index');
            Route::get('/create', 'MaterialController@create');
            Route::post('/', 'MaterialController@store');
            Route::get('/{material}', 'MaterialController@show');
        });

        Route::group(['prefix' => '{turma}/atividade'], function() {
            Route::get('/', 'AtividadeController@index');
            Route::get('/create', 'AtividadeController@create');
            Route::post('/', 'AtividadeController@store');
            Route::get('/{atividade}', 'AtividadeController@show');
            Route::get('/{atividade}/edit', 'AtividadeController@edit');
            Route::put('/{atividade}', 'AtividadeController@update');
            Route::patch('/{atividade}', 'AtividadeController@update');
            Route::get('/{atividade}/cancelar', 'AtividadeController@cancelar');
            Route::get('/{atividade}/descancelar', 'AtividadeController@descancelar');

            Route::group(['prefix' => '{atividade}/nota'], function() {
                Route::get('/create', 'NotaController@create');
                Route::post('/', 'NotaController@store');
                Route::get('/edit', 'NotaController@edit');
                Route::patch('/', 'NotaController@update');
                Route::put('/', 'NotaController@update');
            });
        });
        Route::get('{turma}/notas', 'NotaController@index');

        Route::group(['prefix' => '{turma}/aula'], function() {
            Route::get('/', 'AulaController@index');
            Route::get('/create', 'AulaController@create');
            Route::post('/', 'AulaController@store');
            Route::get('/{aula}', 'AulaController@show');
            Route::get('/{aula}/edit', 'AulaController@edit');
            Route::patch('/{aula}', 'AulaController@update');
            Route::put('/{aula}', 'AulaController@update');
            Route::get('/{aula}/cancelar', 'AulaController@cancelar');
            Route::get('/{aula}/descancelar', 'AulaController@descancelar');

            Route::group(['prefix' => '{aula}/anotacao'], function() {
                Route::get('/create', 'AnotacaoController@create');
                Route::post('/', 'AnotacaoController@store');
                Route::get('/edit', 'AnotacaoController@edit');
                Route::patch('/', 'AnotacaoController@update');
                Route::put('/', 'AnotacaoController@update');
                Route::get('/{anotacao}/show', 'AnotacaoController@show');
            });

        });
        Route::get('{turma}/anotacoes', 'AnotacaoController@index');
        Route::get('{turma}/faltas', 'FaltaController@index');
        Route::post('{turma}/faltas', 'FaltaController@store');
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