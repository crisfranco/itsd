<?php

/*
  |--------------------------------------------------------------------------
  | Application & Route Filters
  |--------------------------------------------------------------------------
  |
  | Below you will find the "before" and "after" events for the application
  | which may be used to do any work before or after a request into your
  | application. Here you may also register your custom route filters.
  |
 */

App::before(function($request) {
    if (Auth::check()) { //Checa se o usuário está logado
        $user = Auth::user();

        $tempo_de_sessao = (($user->perfil == 1) ? 86400 : 3600);

        if ($user->ativo == 0) { //Se o usuário não está ativo...
            Auth::logout(); //Faz logoff
            //Se a requisição for ajax, retorna o código UNA(Usuário Não Ativo), se não, redireciona
            return ($request->ajax()) ? 'UNA' : View::make('login');
        }

        if (time() - $user->last_activity > $tempo_de_sessao) { //Se a sessão expirou...
            Auth::logout(); //Faz logoff
            //Se a requisição for ajax, retorna o código SE(Sessão Expirada), se não, redireciona
            return ($request->ajax()) ? 'SE' : View::make('login');
        } else { //Se a sessão não expirou e o usuário está ativo...
            //Configura o tempo dessa atividade no banco
            //Para atualizações automáticas via ajax, a activity não é atualizada
            if (strpos($request->url(), "gchamadosabertos") === FALSE) {
                $user->last_activity = time();
                $user->save();
            }
        }
    }

    //Cadastra um usuário padrão caso não exista nenhum usuário no banco
    if (Usuarios::get()->count() == 0) {
        DB::table('usuarios')->insert(array(
            'perfil' => '1',
            'username' => 'AIUZQ07',
            'password' => Hash::make('amway'),
            'nome' => 'Cristiano Franco',
            'ramal' => '9854'));

        $u = Usuarios::first();

        return "<h2>Nenhum usuário cadastrado<h2><p>Usuário padrão cadastro</p>Usuário: <b>$u->username</b><br/>Senha: <b>amway</b>";
    }
});


App::after(function($request, $response) {
    // prevent browser caching
    $response->headers->set('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate');
    $response->headers->set('Pragma', 'no-cache');
    $response->headers->set('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
});

/*
  |--------------------------------------------------------------------------
  | Authentication Filters
  |--------------------------------------------------------------------------
  |
  | The following filters are used to verify that the user of the current
  | session is logged into this application. The "basic" filter easily
  | integrates HTTP Basic authentication for quick, simple checking.
  |
 */

Route::filter('auth', function() {
    if (Auth::guest())
        return Redirect::guest('login');
});


Route::filter('auth.basic', function() {
    return Auth::basic();
});

/*
  |--------------------------------------------------------------------------
  | Guest Filter
  |--------------------------------------------------------------------------
  |
  | The "guest" filter is the counterpart of the authentication filters as
  | it simply checks that the current user is not logged in. A redirect
  | response will be issued if they are, which you may freely change.
  |
 */

Route::filter('guest', function() {
    if (Auth::check())
        return Redirect::to('/');
});

/*
  |--------------------------------------------------------------------------
  | CSRF Protection Filter
  |--------------------------------------------------------------------------
  |
  | The CSRF filter is responsible for protecting your application against
  | cross-site request forgery attacks. If this special token in a user
  | session does not match the one given in this request, we'll bail.
  |
 */

Route::filter('csrf', function() {
    if (Session::token() != Input::get('_token')) {
        throw new Illuminate\Session\TokenMismatchException;
    }
});

Route::filter('ajaxCheck', function($route, $request) {
    if (!$request->ajax()) {
        return View::make('/');
    }
});

Route::filter('reqAdmin', function() {
    //Se o usuário que está tentando acessar a rota não tiver credenciais de Administrador...
    if (Auth::user()->perfil != 1) {
        //retorna o erro RPU(Requisição Proibida para Usuários)
        return 'RPU';
    }
});

Route::filter('reqUser', function() {
    //Se o usuário que está tentando acessar a rota não tiver credenciais de Usuário
    if (Auth::user()->perfil != 2) {
        //retorna o erro RPA(Requisição Proibida para Administradores)
        return 'RPA';
    }
});
