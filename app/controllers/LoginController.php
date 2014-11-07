<?php

class LoginController extends BaseController {

    public function show()
    {
        if (Auth::check())
        {
            if (Hash::check('amway', Auth::user()->getAuthPassword()) == true)
            {
                return View::make('login');
            }

            if (Auth::user()->perfil == 1)
            {
                return View::make('dashboard', array(
                            'usuario' => Auth::user()->nome,
                            'qtdUsuarios' => Usuarios::count(),
                            'chamados_abertos' => LauncherController::getChamadosAbertos(),
                            'chamados_fechados' => LauncherController::getChamadosFechados(),
                            'qtdMarcas' => Marcas::count(),
                            'qtdEquipamentos' => Equipamentos::count(),
                            'qtdCategorias' => Categorias::count(),
                            'casos' => Casos::all(),
                            'procedimentos' => array(),
                            'detalhes_chamado' => array()));
            } elseif (Auth::user()->perfil == 2)
            {
                return View::make('operacional', array(
                            'nomeUsuario' => Auth::user()->nome,
                            'chamados_abertos' => LauncherController::getChamadosAbertos(),
                            'chamados_fechados' => LauncherController::getChamadosFechados(),
                            'helpers' => Helpers::with('helperCategoria')->get()));
            }
        } else
        {
            return View::make('login');
        }
    }

    public function fazerLogin()
    {
        $user = array(
            'username' => Input::get('username'),
            'password' => Input::get('password'));

        if (Auth::attempt($user))
        {
            if (Auth::user()->ativo == 0)
            { //Se o usuário não está ativo...
                return 'UNA'; //retorna o código de Usuário Não Ativo(UNA)
            } else
            { //Se ele está ativo
                Auth::user()->last_activity = time();
                Auth::user()->save();
                //SP - Senha Padrão, LR - Login Realizado
                return (Hash::check('amway', Auth::user()->getAuthPassword())) ? 'SP' : 'LR';
            }
        } else
        { //Se não foi possível fazer o login...
            return 'USI'; //retorna o código de Usuário e/ou senha inválido(s)
        }
    }

    public function novaSenha()
    {
        Auth::user()->password = Hash::make(Input::get('novasenha'));
        Auth::user()->save();
        return 'LR';
    }

    public function cadastrarUsuario()
    {
        $result = DB::table('usuarios')->insertGetId(array(
            'id_setor' => Input::get('modalSelectSetores'),
            'id_equipamento' => Input::get('modalSelectEquipamentos'),
            'perfil' => Input::get('perfil'),
            'username' => Input::get('modalCadAIU'),
            'email' => Input::get('modalCadEmail'),
            'password' => Hash::make('amway'),
            'nome' => Input::get('modalCadNome'),
            'cel' => Input::get('modalCadCelular'),
            'ramal' => Input::get('modalCadRamal'),
            'ativo' => (Input::get('usuarioAtivo') != null) ? 1 : 0,
        ));

        if ($result != null && $result > 0)
        {
            return 'UC'; //Usuário Cadastrado
        }
    }

    public function logout()
    {
        if (Auth::check())
        {
            Auth::logout();
            return 'UFL'; //retorna o código de Usuário Fez Logout(UFL)
        }
    }

    //Alterar Senha
    public function alterarSenha()
    {

        $senhaAtual = Input::get('senhaAtual');

        if (Hash::check($senhaAtual, Auth::user()->getAuthPassword()))
        {

            return $this->novaSenha();
        } else
        {
            return 'SI';
        }
    }

}
