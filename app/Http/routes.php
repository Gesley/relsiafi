<?php
use RELSIAFI\Models\Credencial;
use RELSIAFI\Models\Extracao;
use RELSIAFI\Models\Localizacao;
use RELSIAFI\Models\TipoArquivo;
use RELSIAFI\Models\Auditoria;
use RELSIAFI\Models\ExecucaoStatus;
use RELSIAFI\Models\LDAP\User;

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

/**
* Login
*/

Route::group(['prefix' => 'login'], function () {
    Route::post('/', [ 'as' => 'loginLogin', 'uses' => 'Auth\Autenticacao@login']);
    Route::get('/logout', [ 'as' => 'loginLogout', 'uses' => 'Auth\Autenticacao@logout']);
    Route::get('/autenticacao', [ 'as' => 'loginAutorizacao', 'uses' => 'Auth\Autenticacao@getAutenticacao']);
});

/**
 *  Angular JSONs
 */

Route::group(['prefix' => 'api', 'middleware' => 'Autenticacao'], function () {

    Route::group(['prefix' => 'credencial'], function () {
        Route::get('/', function() {
            return response()->json(Credencial::naoDeletado()->get());
        });
        Route::get('/{id}', function($id) {
            return response()->json(Credencial::findOrFail($id));
        });
        Route::post('/', ['uses' => 'Credencial@store']);
        Route::put('/{id}', ['uses' => 'Credencial@update']);
        Route::delete('/{id}', ['uses' => 'Credencial@destroy']);
    });

    Route::group(['prefix' => 'extracao'], function () {
        Route::get('/', function() {
            return response()->json(Extracao::ativo()->get());
        });
        Route::get('/{id}', function($id) {
            return response()->json(Extracao::findOrFail($id));
        });
        Route::post('/', ['uses' => 'Extracao@store']);
        Route::put('/{id}', ['uses' => 'Extracao@update']);
        Route::delete('/{id}', ['uses' => 'Extracao@destroy']);
    });

    Route::group(['prefix' => 'tipo_arquivo'], function () {
        Route::get('/', function() {
            return response()->json(
                TipoArquivo::with('localizacao')
                    ->with('extracao')
                    ->ativo()->get());
        });
        Route::get('/{id}', function($id) {
            return response()->json(
                TipoArquivo::findOrFail($id));
        });
        Route::post('/', ['uses' => 'TipoArquivo@store']);
        Route::put('/{id}', ['uses' => 'TipoArquivo@update']);
        Route::delete('/{id}', ['uses' => 'TipoArquivo@destroy']);
    });

    Route::group(['prefix' => 'localizacao'], function () {
        Route::get('/', function() {
            return response()->json(Localizacao::all());
        });
        Route::get('/{id}', function($id) {
            return response()->json(Localizacao::findOrFail($id));
        });
    });

    Route::group(['prefix' => 'execucao_status'], function () {
        Route::get('/', function() {
            return response()->json(ExecucaoStatus::all());
        });
        Route::get('/{id}', function($id) {
            return response()->json(ExecucaoStatus::findOrFail($id));
        });
    });

    Route::group(['prefix' => 'auditoria'], function () {
        Route::get('/', function() {
            return response()->json(
                Auditoria::with(
                       'credencial',
                       'status',
                       'tipo_arquivo',
                       'tipo_arquivo.localizacao',
                       'tipo_arquivo.extracao',
                       'arquivo_recebido'
                    )->get()
            );
        });
    });

    Route::group(['prefix' => 'ldap'], function () {
        Route::get('/', function() { return response()->json(User::getAllUsers());});
    });
});

/**
 * Blade Views
 */

Route::get('/', [ 'as' => 'Home', 'uses' => 'Application@index']);

Route::group(['prefix' => 'layout'], function () {
    Route::get('/modal-with-confirmation', function() {
        return view('layout/modal-with-confirmation');
    });

    Route::get('/modal-content', function() {
        return view('layout/modal-content');
    });

    Route::get('/login', function() {
        return view('layout/login');
    });
});

Route::group(['prefix' => 'credencial', 'middleware' => 'Autenticacao'], function () {
    Route::get('/', [ 'as' => 'homeCredencial', 'uses' => 'Credencial@index']);
    Route::get('create', [ 'as' => 'createCredencial', 'uses' => 'Credencial@create']);
    Route::get('edit', [ 'as' => 'updateCredencial', 'uses' => 'Credencial@edit']);
    Route::get('ldap_users', [ 'as' => 'LDAPUsers', 'uses' => 'Credencial@getAllLDAPUsers']);
});

Route::group(['prefix' => 'extracao', 'middleware' => 'Autenticacao'], function () {
    Route::get('/', [ 'as' => 'homeExtracao', 'uses' => 'Extracao@index']);
    Route::get('create', [ 'as' => 'createExtracao', 'uses' => 'Extracao@create']);
    Route::get('edit', [ 'as' => 'updateExtracao', 'uses' => 'Extracao@edit']);
});

Route::group(['prefix' => 'tipo_arquivo', 'middleware' => 'Autenticacao'], function () {
    Route::get('/', [ 'as' => 'homeTipoArquivo', 'uses' => 'TipoArquivo@index']);
    Route::get('create', [ 'as' => 'createTipoArquivo', 'uses' => 'TipoArquivo@create']);
    Route::get('edit', [ 'as' => 'updateTipoArquivo', 'uses' => 'TipoArquivo@edit']);
    Route::get('regex-help', function() {
        return view('tipo_arquivo/regex-help');
    });
});

Route::group(['prefix' => 'relatorio', 'middleware' => 'Autenticacao'], function () {
    Route::get('/', [ 'as' => 'homeRelatorio', 'uses' => 'Relatorio@index']);
    Route::post('/', ['uses' => 'Relatorio@render']);
});

Route::group(['prefix' => 'auditoria', 'middleware' => 'Autenticacao'], function () {
    Route::get('/', [ 'as' => 'homeAuditoria', 'uses' => 'Auditoria@index']);
});
