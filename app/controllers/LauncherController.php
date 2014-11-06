<?php

class LauncherController extends BaseController {

    public function noIE()
    {
        return View::make('errors.noie');
    }

    //USUÁRIOS
    public function usuarios()
    {
        return View::make('admins.usuarios', array(
                    'setores' => Setores::get(),                    
                    'todos_os_usuarios' => Usuarios::get()
        ));
    }

    //MARCAS
    public function marcas()
    {
        return View::make('admins.marcas', array(
                    'todas_as_marcas' => Marcas::get()));
    }

    public function cadMarca()
    {
        $result = DB::table('marcas')->insertGetId(array(
            'nome' => Input::get('mNome')));

        if ($result != null && $result > 0)
        {
            return $this->marcas();
        }
    }

    public function excMarca()
    {
        $marca = Marcas::find(Input::get('id'));

        if ($marca != null)
        {
            $marca->delete();
            return $this->marcas();
        }
    }

    public function editMarca()
    {
        $marca = Marcas::find(Input::get('id'));

        if ($marca != null)
        {
            $marca->nome = Input::get('novoNome');

            $marca->save();

            return $this->marcas();
        }
    }

    //CATEGORIAS
    public function categorias()
    {
        return View::make('admins.categorias', array(
                    'todas_as_categorias' => Categorias::get()));
    }

    public function cadCategoria()
    {
        $result = DB::table('categorias')->insertGetId(array(
            'nome' => Input::get('cNome')));

        if ($result != null && $result > 0)
        {
            return $this->categorias();
        }
    }

    public function excCategoria()
    {
        $categoria = Categorias::find(Input::get('id'));

        if ($categoria != null)
        {
            $categoria->delete();
            return $this->categorias();
        }
    }

    public function editCategoria()
    {
        $categoria = Categorias::find(Input::get('id'));

        if ($categoria != null)
        {
            $categoria->nome = Input::get('novoNome');

            $categoria->save();

            return $this->categorias();
        }
    }

    //EQUIPAMENTOS
    public function equipamentos()
    {
        return View::make('admins.equipamentos', array(
                    'todas_os_equipamentos' => Equipamentos::with('marca', 'categoria', 'setor')->get(),
                    'categorias' => Categorias::get(),
                    'marcas' => Marcas::get(),
                    'setores' => Setores::get()
        ));
    }
    
    public function equipamentosPorSetor()
    {
        return View::make('admins.equipamentos_por_setor', array(
                    'equipamentos_por_setor' => Equipamentos::with('setor')->where('id_setor', '=', Input::get('idSetor'))->get()
        ));
    }

    public function cadEquipamento()
    {
        $idEquipamento = null;

        if (Input::get('sCategorias') == '1' || Input::get('sCategorias') == '2')
        {
            $idEquipamento = DB::table('equipamentos')->insertGetId(array(
                'id_marca' => Input::get('sMarcas'),
                'id_categoria' => Input::get('sCategorias'),
                'id_setor' => Input::get('sSetores'),
                'nome' => Input::get('equipNome'),
                'cn' => Input::get('equipCN'),
                'so' => Input::get('equipSO'),
                'processador' => Input::get('equipProcessador'),
                'memoria' => Input::get('equipMemoria'),
                'hd' => Input::get('equipHD'),
                'patrimonio_cpu' => Input::get('equipPatrimonioCPU'),
                'patrimonio_monitor' => Input::get('equipPatrimonioMonitor'),
                'dt_aquisicao' => DataFormater::formatar(Input::get('equipDataAquisicao')),
                'dt_garantia' => DataFormater::formatar(Input::get('equipDataGarantia')),
                'service_tag' => Input::get('equipST')
            ));
        } else
        {
            $idEquipamento = DB::table('equipamentos')->insertGetId(array(
                'id_marca' => Input::get('sMarcas'),
                'id_categoria' => Input::get('sCategorias'),
                'id_setor' => Input::get('sSetores'),
                'nome' => Input::get('equipNome'),
                'dt_aquisicao' => DataFormater::formatar(Input::get('equipDataAquisicao')),
                'dt_garantia' => DataFormater::formatar(Input::get('equipDataGarantia')),
                'service_tag' => Input::get('equipST'),
                'patrimonio' => Input::get('equipPatrimonio')
            ));
        }

        if ($idEquipamento != null && $idEquipamento > 0)
        {
            return $this->equipamentos();
        }
    }

    public function excEquipamento()
    {
        $equipamento = Equipamentos::find(Input::get('id'));

        if ($equipamento != null)
        {
            $equipamento->delete();
        }

        return $this->equipamentos();
    }

    public function editEquipamento()
    {
        $equipamento = Equipamentos::find(Input::get('idEquip'));

        if ($equipamento != null)
        {
            $equipamento->id_marca = Input::get('eSMarcas');
            $equipamento->id_categoria = Input::get('eSCategorias');
            $equipamento->id_setor = Input::get('eSSetores');
            $equipamento->nome = Input::get('eEquipNome');
            $equipamento->dt_aquisicao = DataFormater::formatar(Input::get('eEquipDataAquisicao'));
            $equipamento->dt_garantia = DataFormater::formatar(Input::get('eEquipDataGarantia'));

            if (Input::get('eSCategorias') == '1' || Input::get('eSCategorias') == '2')
            {
                $equipamento->cn = Input::get('eEquipCN');
                $equipamento->processador = Input::get('eEquipProcessador');
                $equipamento->memoria = Input::get('eEquipMemoria');
                $equipamento->hd = Input::get('eEquipHD');
                $equipamento->so = Input::get('eEquipSO');
                $equipamento->patrimonio = null;
                $equipamento->patrimonio_cpu = Input::get('eEquipPatrimonioCPU');
                $equipamento->patrimonio_monitor = Input::get('eEquipPatrimonioMonitor');
                $equipamento->service_tag = Input::get('eEquipST');
            } else
            {
                $equipamento->cn = null;
                $equipamento->processador = null;
                $equipamento->memoria = null;
                $equipamento->hd = null;
                $equipamento->so = null;
                $equipamento->patrimonio = Input::get('eEquipPatrimonio');
                $equipamento->patrimonio_cpu = null;
                $equipamento->patrimonio_monitor = null;
                $equipamento->service_tag = null;
            }

            $equipamento->save();

            return $this->equipamentos();
        }
    }

    //PEGAR AS CATEGORIAS DOS HELPERS
    public function getHelpersCategorias()
    {
        return Response::json(HelpersCategorias::where('id_helper', '=', Input::get('id'))->get(array(
                            'id',
                            'nome',
                            'prioridade')));
    }

    //CHAMADOS
    public function chamados()
    {
        return View::make('users.chamados', array(
                    'chamados_abertos' => $this->getChamadosAbertos(),
                    'chamados_fechados' => $this->getChamadosFechados(),
                    'helpers' => Helpers::with('helperCategoria')->get()
        ));
    }

    public function getDadosChamado()
    {
        return View::make('admins.modal_chamados', array(
                    'procedimentos' => Procedimentos::all(),
                    'casos' => Casos::all(),
                    'detalhes_chamado' => Chamados::with('servico', 'usuario', 'status', 'usuarioAtendido', 'chamadoCaso')
                            ->where('id', '=', Input::get('id'))->get()));
    }

    public function gChamadosAbertos()
    {
        if (Auth::user()->perfil == 1)
        {
            return View::make('admins.a_chamados', array(
                        'chamados_abertos' => $this->getChamadosAbertos(),
                        'casos' => Casos::all(),
                        'procedimentos' => array(),
                        'detalhes_chamado' => array()
            ));
        } else
        {//Continua aqui
            //definir as variáveis passadas para a page lista_chamados_abertos
            return View::make('users.lista_chamados_abertos', array(
                        'chamados_abertos' => $this->getChamadosAbertos(),
                        'casos' => Casos::all(),
                        'procedimentos' => array(),
                        'detalhes_chamado' => array()
            ));
        }
    }

    public function gChamadosFechados()
    {
        if (Auth::user()->perfil == 1)
        {
            return View::make('admins.a_chamados_fechados', array(
                        'chamados_fechados' => $this->getChamadosFechados(),
                        'casos' => Casos::all(),
                        'procedimentos' => array(),
                        'detalhes_chamado' => array()
            ));
        } else
        {//Continua aqui
            //definir as variáveis passadas para a page lista_chamados_fechados
            return View::make('users.lista_chamados_fechados', array(
                        'chamados_fechados' => $this->getChamadosFechados(),
                        'casos' => Casos::all(),
                        'procedimentos' => array(),
                        'detalhes_chamado' => array()
            ));
        }
    }

    public static function getChamadosAbertos()
    {
        if (Auth::user()->perfil == 1)
        {
            return Chamados::with('helperCategoria', 'servico', 'status')->where('id_status', '!=', '3')->where('id_status', '!=', '4')->get();
        } else
        {
            return Chamados::with('helperCategoria', 'servico', 'status')->where('id_status', '!=', '3')->where('id_status', '!=', '4')->where('id_usuario', '=', Auth::user()->id)->get();
        }
    }

    public static function getChamadosFechados()
    {
        if (Auth::user()->perfil == 1)
        {
            return Chamados::with('helperCategoria', 'servico', 'status')->where('id_status', '=', '3')->get();
        } else
        {
            return Chamados::with('helperCategoria', 'servico', 'status')->where('id_status', '=', '3')->where('id_usuario', '=', Auth::user()->id)->orderBy('id', 'DESC')->get();
        }
    }

    public function cadChamados()
    {
        $idHelpCat = null;
        if (Input::has('prioridadeMaxima'))
        {
            $idHelpCat = Input::get('ckP');
        } else
        {
            $idHelpCat = (Input::get('sSubCategorias') == null) ? 23 : Input::get('sSubCategorias');
        }

        //Se o usuário q está abrindo o chamado for usuário comum, os id's são iguais
        //Caso contrário, o id do usuário atendido é enviado na requisição (temporariamente assumindo o valor '1')
        $usuarioAtendido = ((Auth::user()->perfil == 2) ? Usuarios::with('setor')->where('id', '=', Auth::user()->id)->first()->toArray() : Input::get('id_usuario_alvo'));

        //Definindo a prioridade do chamado
        //A prioridade do chamado será a soma da prioridade do setor com a prioridade da helper_categoria        
        $prioridade = $usuarioAtendido['setor']['prioridade'] + HelpersCategorias::where('id', '=', Input::get('ckP'))->first()->toArray()['prioridade'];

        DB::table('chamados')->insert(array(
            'id_usuario' => Auth::user()->id,
            'id_usuario_atendido' => $usuarioAtendido['id'],
            'id_helper_categoria' => $idHelpCat,
            'texto' => Input::get('info'),
            'prioridade' => $prioridade
        ));

        MailController::notificarAberturaChamado();

        return $this->chamados();
    }

    public function reabrirChamado()
    {
        //Precisamos duplicar um registro já inserido no BD, alterando alguns valores
        DB::transaction(function() {

            $chamado = Chamados::find(Input::get('hIdChamado'));

            DB::table('chamados')->insert(array(
                'id_usuario' => $chamado->id_usuario,
                'id_usuario_atendido' => $chamado->id_usuario_atendido,
                'id_helper_categoria' => $chamado->id_helper_categoria,
                'id_status' => 5,
                'texto' => Input::get('novaMensagem'),
                'prioridade' => $chamado->prioridade,
                'reaberto_de' => $chamado->id
            ));

            $chamado->reaberto = 1;

            $chamado->save();

            //MailController::notificarReaberturaChamado();
        });

        return $this->chamados();
    }

    public function atualizarChamado()
    {
        DB::transaction(function() {
            $idChamado = Input::get('id_chamado');

            //Excluir tudo daquele chamado da tabela servicos
            Servicos::where('id_chamado', '=', $idChamado)->delete();

            //Excluir tudo daquele chamado da tabela chamados_casos
            ChamadosCasos::where('id_chamado', '=', $idChamado)->delete();

            $emAtendimento = false; //Variável servirá para identificar se o status do chamado está "Em atendimento"
            //Reinserir os dados na tabela servicos
            foreach (explode('-', Input::get('casos')) as $value)
            {
                if ($value !== "")
                {
                    $emAtendimento = true; //Se houver alterações, a variável receberá true;
                    DB::table('chamados_casos')->insert(array(
                        'id_chamado' => $idChamado,
                        'id_caso' => $value));
                }
            }

            //reinserir os dados na tabela chamdos_casos
            foreach (explode('-', Input::get('procedimentos')) as $value)
            {
                if ($value !== "")
                {
                    $emAtendimento = true; //Se houver alterações, a variável receberá true;
                    //$teste .= 'Valor: ' . $value . ', ';
                    DB::table('servicos')->insert(array(
                        'id_chamado' => $idChamado,
                        'id_procedimento' => $value));
                }
            }

            /* CONFIGURAR:
             * 1 - O TEXTO QUE O USUÁRIO ESCREVE NÃO PODERÁ SER ALTERADO PELO ADMINISTRADOR
             */
            //Atualizar o chamado na tabela de chamados
            $chamado = Chamados::find($idChamado);

            $chamado->atendido_por = Auth::user()->id;

            $chamado->diagnostico = Input::get('diagnostico');


            //Se o chamado começou a ser atendido, o status dele é 1 ou 5
            //Então, grava-se o início do atendimento
            if ($chamado->id_status == 1 || $chamado->id_status == 5)
            {
                $chamado->dt_inicio_atendimento = new \DateTime;
            }

            if ($emAtendimento == true)
            {
                $chamado->id_status = 2;
            }

            $encerrado = Input::get('encerrado');
            if ($encerrado == '3')
            {
                $chamado->id_status = $encerrado;
                $chamado->dt_fechamento = new \DateTime;
                MailController::notificarEncerramentoChamado(array(
                    'idChamado' => $chamado->usuario->id,
                    'usuario' => $chamado->usuario->nome,
                    'emailUsuario' => $chamado->usuario->email,
                    'texto' => $chamado->texto,
                    'diagnostico' => $chamado->diagnostico
                ));
            }

            $chamado->save();
        });
    }

    public function excluirChamado()
    {

        $chamado = Chamados::find(Input::get('idC'));

        if ($chamado != null && $chamado->id_status === 1)
        {
            $chamado->id_status = '4';
            $chamado->save();
        }

        return 'Chamado excluído!';
    }

    // PROCEDIMENTOS
    public function cadastrarProcedimento()
    {
        $result = DB::table('procedimentos')->insertGetId(array(
            'nome' => Input::get('nome_procedimento')));

        if ($result != null && $result > 0)
        {
            return $result;
        }
    }

}
