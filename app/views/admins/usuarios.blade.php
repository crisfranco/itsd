<div class="box">
    <div class="box-header">
        <h3 class="box-title">Usuários cadastrados no sistema</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-dropbox btn-xs launch-modal" data-toggle="modal" title="Cadastrar um novo usuário">Adicionar novo...</button>            
        </div>
        <!-- Modal HTML -->
        <div id="modalCadUsuario" class="modal fade">
            <div class="modal-dialog" style="width: 700px">
                <div class="modal-content">
                    <form id="frmNovoUsuario">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Cadastrar Novo Usuário</h4>
                        </div>
                        <div class="modal-body">
                            <p>                                
                                <select id="modalSelectSetores" name="modalSelectSetores" class="form-control input-lg">
                                    <option value selected disabled style="display: none;">Setores</option>
                                    <?php foreach ($setores as $setor): ?>
                                        <option value="{{ $setor->id; }}">{{ $setor->nome; }}</option>
                                    <?php endforeach; ?>
                                </select>
                            </p>
                            <p>                                
                                <select id="modalSelectEquipamentos" name="modalSelectEquipamentos" class="form-control input-lg"></select>
                            </p>
                            <div class="panel panel-default">
                                <div class="panel-heading">Perfil</div>
                                <div class="panel-body">
                                    <div id="opcoesAU" class="form-inline">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="perfil" value="2" id="perfilU" checked>
                                                Usuário
                                            </label>
                                            <label style="padding-left: 24px;">
                                                <input type="radio" name="perfil" value="1" id="perfilA">
                                                Administrador
                                            </label>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>

                            <p>
                                <input id="modalCadAIU" name="modalCadAIU" type="text" placeholder="AIU" class="floatlabel form-control input-lg">
                            </p>                            
                            <p>
                                <input id="modalCadNome" name="modalCadNome" type="text" placeholder="Nome" class="floatlabel form-control input-lg">
                            </p>
                            <p>
                                <input id="modalCadEmail" name="modalCadEmail" type="text" placeholder="E-mail" class="floatlabel form-control input-lg">
                            </p>
                            <p>
                                <input id="modalCadCelular" name="modalCadCelular" type="text" placeholder="Celular Corporativo" class="floatlabel form-control input-lg">
                            </p>                            
                            <p>
                                <input id="modalCadRamal" name="modalCadRamal" type="text" placeholder="Ramal" class="floatlabel form-control input-lg">
                            </p>
                            <p>
                            <div class="checkbox">
                                <label>
                                    <input name="usuarioAtivo" type="checkbox" id="modalCadAtivo" checked> Ativo
                                </label>
                            </div>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="modalCadClose" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="button" id="mocalCadSubmit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <div class="box-body">        
        <table id="listaUsuarios" class="table-responsive table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>AIU</th>
                    <th>Computador</th>
                    <th>Setor</th>
                    <th>Ramal</th>                    
                    <th>Última Atividade</th>
                    <th>Celular</th>
                    <th>Perfil</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>
            </thead>            
            <tbody>                
                <?php foreach ($todos_os_usuarios as $u) : ?>
                    <tr>
                        <td><?php echo $u->id; ?></td>
                        <td><?php echo $u->nome; ?></td>
                        <td><?php echo $u->username; ?></td>
                        <td><?php echo ((!is_null($u->equipamento)) ? $u->equipamento->cn : ''); ?></td>
                        <td><?php echo ((!is_null($u->setor)) ? $u->setor->sigla : ''); ?></td>
                        <td><?php echo $u->ramal; ?></td>
                        <td><?php echo gmdate('d.m.Y, H:i:s', $u->last_activity); ?></td>
                        <td><?php echo $u->cel; ?></td>
                        <td><?php echo (($u->perfil == 1) ? 'Administrador' : 'Usuário'); ?></td>
                        <td><?php echo (($u->ativo == 1) ? 'sim' : 'não'); ?></td>
                        <td>
                            <button id="btnExcluir" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Excluir"><i class="fa fa-eraser"></i></button> 
                            <button id="btnEditar" class="btn btn-github btn-xs" data-toggle="tooltip" title="Editar"><i class="fa fa-gears"></i></button></td>
                    </tr>
                <?php endforeach; ?>                
            </tbody>            
        </table>
    </div><!-- /.box-body -->   
</div><!-- /.box -->
</div>

<script type="text/javascript">

    function formatarEmail() {
        var emailAmway = '@amway.com';
        if ($('#modalCadEmail').val() === emailAmway || $('#modalCadAIU').val().trim() === '') {            
            $('#modalCadEmail').val('');
        } else {
            var emailCompleto = $('#modalCadAIU').val() + emailAmway;
            $('#modalCadEmail').val(emailCompleto);
        }
        $('#modalCadEmail').blur();
    }
    
    $(function () {
        
        $('#modalCadAIU').on("propertychange change keyup paste input", function () {
            formatarEmail();
        });

        $('#mocalCadSubmit').click(function () {
            //verificar se todos os campos estão preenchidos
            var msgPadrao = 'Erro(s) de preenchimento do formulário:\n';
            var msgErro = msgPadrao;
            if ($('#modalSelectSetores option:selected').val() === '') {
                msgErro += '\n -> Selecione um setor.';
            }

            if (!$("#modalSelectEquipamentos").find("option:selected").length || $('#modalSelectEquipamentos option:selected').val() === '') {
                msgErro += '\n -> Selecione um equipamento.';
            }

            if ($('#modalCadAIU').val().trim() === '') {
                msgErro += '\n -> Informe o AIU do usuário.';
                $('#modalCadAIU').val('');
            }

            if ($('#modalCadNome').val().trim() === '') {
                msgErro += '\n -> Informe o nome do usuário.';
                $('#modalCadNome').val('');
            }

            if ($('#modalCadEmail').val().trim() === '') {
                msgErro += '\n -> Informe o email do usuário.';
                $('#modalCadEmail').val('');
            }

            if (msgErro !== msgPadrao) {
                alert(msgErro);
                msgErro = msgPadrao;
                return;
            }

            //submeter o formulário por ajax
            $.ajax({
                type: 'post',
                url: 'cadusuario',
                data: $('#frmNovoUsuario').serialize()
            }).done(function (data) {

                switch (data) {
                    case 'UNA':
                        console.log('UNA - Usuário Não Ativo');
                        window.location.replace('');
                        break;
                    case 'SP':
                        console.log('SP - Senha Padrão. Por favor, mudar a senha.');
                        window.location.replace('');
                        break;
                    case 'UFL':
                        console.log('UFL - Usuário Fez Logout');
                        window.location.replace('');
                        break;
                    case 'USI':
                        console.log('USI - Usuário e/ou senha inválido(s), se o problema persistir contate-nos no ramal 9854');
                        window.location.replace('');
                        break;
                        
                        case 'UC':
                        console.log('UC - Usuário Cadastrado!');                        
                        break;
                }

            }).fail(function (xhr, status, error) {
                console.log(xhr.responseText);
                alert('Ocorreu um erro com sua requisição. Por favor, contate a TI no ramal 9854.');
            });
            //aguardar a resposta de cadastro ok
            //exibir confirmação para o usuário
            //perguntar se deseja cadastrar novo usuário:
            //Se sim, focu no primeiro controle
            //Se não, fechar a janela modal
        });



        $('#modalCadUsuario').on('shown.bs.modal', function (e) {
            e.preventDefault();
            $('#modalSetores').focus();
        });

        $('.launch-modal').click(function () {
            $('#modalCadUsuario').modal({
                keyboard: true,
                backdrop: 'static'
            });
        });

        $('#modalSelectSetores').change(function () {

            $('#modalSelectEquipamentos').attr('disabled', 'disabled');

            $.ajax({
                type: 'get',
                url: 'getequipamentosporsetor',
                data: {idSetor: $('#modalSelectSetores option:selected').val()}
            }).done(function (data) {

                switch (data) {
                    case 'UNA':
                        console.log('UNA - Usuário Não Ativo');
                        window.location.replace('');
                        break;
                    case 'SP':
                        console.log('SP - Senha Padrão. Por favor, mudar a senha.');
                        window.location.replace('');
                        break;
                    case 'UFL':
                        console.log('UFL - Usuário Fez Logout');
                        window.location.replace('');
                        break;
                    case 'USI':
                        console.log('USI - Usuário e/ou senha inválido(s), se o problema persistir contate-nos no ramal 9854');
                        window.location.replace('');
                        break;
                }

                $('#modalSelectEquipamentos').html(data);

                $('#modalSelectEquipamentos').removeAttr('disabled');

            }).fail(function (xhr, status, error) {
                console.log(xhr.responseText);
                alert('Ocorreu um erro com sua requisição. Por favor, contate a TI no ramal 9854.');
            });
        });

        $('#opcoesAU input').iCheck({
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });

        $('#modalCadAtivo').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            increaseArea: '20%'
        });
        $('.content-header h1').html('Usuários <small>listagem geral</small>');

        var oTable = $('#listaUsuarios').dataTable({
            "language": {
                "sProcessing": "Processando...",
                "sLengthMenu": "Mostrar _MENU_ registros", "sZeroRecords": "Não foram encontrados resultados",
                "sInfo": "Mostrando de <code>_START_</code> até <code>_END_</code> de <code>_TOTAL_</code> registros",
                "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
                "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Primeiro",
                    "sPrevious": "Anterior",
                    "sNext": "Seguinte",
                    "sLast": "Último"
                }
            },
            aoColumnDefs: [//Desabilitando o sorting para a última coluna (Ações)
                {
                    bSortable: false,
                    aTargets: [-1]
                }
            ]
        });

        $('table a').click(function (e) {
            e.preventDefault();
        });
    });
</script>
