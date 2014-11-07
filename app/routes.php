<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::get('/', 'LoginController@show');

Route::get('noie', 'LauncherController@noIE');

Route::post('novasenha', 'LoginController@novaSenha');

Route::any('logout', 'LoginController@logout');

Route::group(array(
    'before' => 'ajaxCheck'), function() {
    Route::post('/', 'LoginController@fazerLogin');

    //CHAMADOS
    Route::post('cadchamadou', 'LauncherController@cadChamados');

    Route::post('reabrirchamado', 'LauncherController@reabrirChamado');

    Route::get('gchamadosabertos', 'LauncherController@gChamadosAbertos');

    Route::get('gchamadosfechados', 'LauncherController@gChamadosFechados');
});

Route::group(array(
    'before' => 'ajaxCheck|reqAdmin'), function() {
//EQUIPAMENTOS
    Route::get('gequipamentos', 'LauncherController@equipamentos');
    
    Route::get('getequipamentosporsetor', 'LauncherController@equipamentosPorSetor');

    Route::post('cadequipamento', 'LauncherController@cadEquipamento');

    Route::post('excequipamento', 'LauncherController@excEquipamento');

    Route::post('editequipamento', 'LauncherController@editEquipamento');

//USUÁRIOS
    Route::get('gusuarios', 'LauncherController@usuarios');
    Route::post('cadusuario', 'LoginController@cadastrarUsuario');

//MARCAS
    Route::get('gmarcas', 'LauncherController@marcas');

    Route::post('cadmarca', 'LauncherController@cadMarca');

    Route::post('excmarca', 'LauncherController@excMarca');

    Route::post('editmarca', 'LauncherController@editMarca');

//CATEGORIAS
    Route::get('gcategorias', 'LauncherController@categorias');

    Route::post('cadcategoria', 'LauncherController@cadCategoria');

    Route::post('exccategoria', 'LauncherController@excCategoria');

    Route::post('editcategoria', 'LauncherController@editCategoria');

// CHAMADOS
    Route::get('getdadoschamado', 'LauncherController@getDadosChamado');

    Route::post('atualizarchamado', 'LauncherController@atualizarChamado');

// PROCEDIMENTOS
    Route::post('cadprocedimento', 'LauncherController@cadastrarProcedimento');
});

Route::group(array(
    'before' => 'ajaxCheck|reqUser'), function() {
//CATEGORIAS DOS HELPERS
    Route::get('cathelpers', 'LauncherController@getHelpersCategorias');

    //CATEGORIAS DOS HELPERS
    Route::post('alterarsenha', 'LoginController@alterarSenha');
});

//TESTE DE EMAIL
Route::post('enviaremail', 'MailController@enviarEmail');

//EXCLUIR CHAMADO UM CHAMADO
Route::post('excchamado', 'LauncherController@excluirChamado');
