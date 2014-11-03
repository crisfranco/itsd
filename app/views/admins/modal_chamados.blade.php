<div class="modal-dialog" style="width: 850px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            $idChamado = null;
            $solicitante = null;
            $usuario_atendido = null;
            $cn = null;
            $texto = null;
            $servicos = null;
            $chamadosCasos = null;
            $statusChamado = null;
            $chelper = null;
            $chelperc = null;
            $ramal = null;
            $diagnostico = null;
            foreach ( $detalhes_chamado as $dc )
            {
                $idChamado = $dc->id;
                $solicitante = $dc->usuario->nome;
                $usuario_atendido = $dc->usuarioAtendido->nome;
                $cn = $dc->usuario->equipamento->cn;
                $texto = $dc->texto;
                $servicos = $dc->servico;
                $chamadosCasos = $dc->chamadoCaso;
                $statusChamado = $dc->id_status;
                $chelper = $dc->helperCategoria->helper->nome;
                $chelperc = $dc->helperCategoria->nome;
                $ramal = $dc->usuarioAtendido->ramal;
                $diagnostico = $dc->diagnostico;
            }
            ?>            
            <h4 class="modal-title" id="myModalLabel">Chamado nº <code id="lblCodChamado">{{ $idChamado; }}</code>
                <small>&nbsp;|&nbsp;
                    Solicitante: <span id="lblNome"><b>{{ $usuario_atendido; }}</b></span>,&nbsp;&nbsp;
                    CN: <span id="lblCN"><b>{{ $cn; }}</b></span>,&nbsp;&nbsp;
                    Ramal: <span id="lblRamal"><b>{{ $ramal; }}</b></span>
                </small>
            </h4>
        </div>
        <div class="modal-body">
            <div class="callout callout-danger">
                <h4>{{ $chelper; }} - {{ $chelperc; }}</h4>
                <p>{{ $texto; }}</p>
            </div>
            <form>
                <input id="mh_idChamado" name="mh_idChamado" type="hidden" value="{{ $idChamado; }}">
                <table id="tabelaAtendimentoChamaods" class="table table-bordered table-striped">
                    <tr>
                        <th>Caso</th>
                        <th>Atendimento</th>
                    </tr>
                    <tr>
                        <td style="width: 200px; border-right: solid 1px #ddd;">
                            <div id="divCasos">
                                <?php foreach ( $casos as $c ) : ?>
                                    <label style="display: block;">
                                        <input type="checkbox" value="{{ $c->id; }}" name="caso{{ $c->id; }}" id="caso{{ $c->id; }}"
                                        <?php
                                        if ( !is_null( $chamadosCasos ) )
                                        {
                                            foreach ( $chamadosCasos as $cc )
                                            {
                                                if ( $cc->id_caso == $c->id )
                                                {
                                                    echo 'checked';
                                                }
                                            }
                                        }
                                        ?>
                                               >
                                        <span class="ckbTexto">{{ $c->nome; }}</span>
                                    </label>
                                <?php endforeach; ?>
                                <input id="hcasos" name="hcasos" type="hidden" value="">
                            </div>
                        </td>
                        <td>
                            <table id="tabDetalhes" class="col-md-12">
                                <tr>
                                    <td style="width: 300px;"> 
                                        <p>
                                            <label>Procedimento</label> <a id="novoProcedimento" href="#"><i class="fa fa-fw fa-plus"></i></a>
                                        <div id="cadProcedimento" class="hide">                                            
                                            <input id="nomeProcedimento" type="text" class="form-control input-lg" placeholder="Novo Procedimento">
                                            <div class="text-right"><a href="#" id="cadastrarProcedimento">Cadastrar</a></div>
                                            <br />
                                        </div>                                            
                                        <select id="sProcedimentos" name="sProcedimentos" class="form-control input-lg">
                                            <option value></option>
                                            <?php foreach ( $procedimentos as $p ) : ?>
                                                <option value="{{ $p->id; }}">{{ $p->nome; }}</option>                                               
                                            <?php endforeach; ?>
                                        </select>

                                        </p>                                        
                                        <p>
                                            <label style="display: block;">
                                                <input class="icheckbox_flat-red" type="checkbox" value="1" name="ckbEncerrarChamado" id="ckbEncerrarChamado"
                                                <?php
                                                if ( $statusChamado == '3' )
                                                {
                                                    echo 'checked';
                                                }
                                                ?> >
                                                <span class="ckbTexto">Encerrar o chamado</span>
                                                <input type="hidden" id="hencerrado" name="hencerrado" value>
                                            </label>
                                        </p>
                                        <p>                                            
                                            <textarea class="form-control" id="taDiagnostico" name="taDiagnostico" placeholder="Diagnóstico final" style="min-height: 150px;">{{ $diagnostico; }}</textarea>
                                        </p>
                                    </td>
                                    <td>
                                        <div class="box box-primary">
                                            <div class="box-header">
                                                <i class="ion ion-clipboard"></i>
                                                <h3 class="box-title">Procedimentos</h3>                                                    
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <?php if ( !is_null( $servicos ) ) : ?>
                                                    <ul class="todo-list procedimentos">
                                                        <?php foreach ( $servicos as $s ) : ?>
                                                            <li>
                                                                <input type="hidden" value="{{ $s->id_procedimento; }}">
                                                                <span class="text">{{ $s->procedimento->nome; }}</span>
                                                                <div class="tools">
                                                                    <i class="fa fa-times"></i>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; ?>   
                                                    </ul>
                                                <?php endif; ?>
                                                <input type="hidden" id="hprocedimentos" name="hprocedimentos" value>
                                            </div><!-- /.box-body -->                                                
                                        </div><!-- /.box -->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="modal-footer">            
            <button type="button" id="fecharModal" class="btn btn-default btn-flat">Fechar</button>
            <button id="btnAtualizar" name="btnAtualizar" type="button" class="btn btn-dropbox btn-flat">Atualizar</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        
        $('#fecharModal').click(function(){
            $('#modalChamado').modal('hide');
            console.log('fechou a modal!');
        });
        
        $('#cadastrarProcedimento').click(function(e){
            e.preventDefault();
            //alert($('#nomeProcedimento').val());
            
            $.ajax({
                type: 'POST',
                url: 'cadprocedimento',
                data: {nome_procedimento: $('#nomeProcedimento').val()}
            }).done(function(data) {

                switch (data) {
                    case 'UNA':
                        console.log('UNA - Usuário Não Ativo');
                        window.location.replace('');
                        break;
                    case 'SE':
                        console.log('SE - Sessão Expirada');
                        window.location.replace('');
                        break;
                    case 'RPU':
                        console.log('RPU - Requisição Proibida para Usuários');
                        window.location.replace('');
                        break;
                    case 'RPA':
                        console.log('RPA - Requisição Proibida para Administradores');
                        window.location.replace('');
                        break;
                    case 'UFL':
                        console.log('UFL - Usuário Fez Logout');
                        window.location.replace('');
                        break;
                }

                //Colocar aqui a rotina para adicionar mais um item ao select "sProcedimentos"
                //Configurando seu value com o id retornado
                var nomeProcedimento = $("#nomeProcedimento").val();
                $('#sProcedimentos').append('<option value="' + data + '">' + nomeProcedimento + '</option>');
                $('#novoProcedimento').val("");

            }).fail(function(xhr, status, error) {
                alert('Ocorreu um erro com a sua requisição.\nPor favor entre em contato com a TI no ramal 9854.');
                console.log(xhr.responseText);
            });
            
        });

        $('#novoProcedimento').click(function(e) {
            e.preventDefault();
            var divCadProc = $('#cadProcedimento');
            if (divCadProc.hasClass('hide')) {
                divCadProc.removeClass('hide');
                $('#novoProcedimento').html('<i class="fa fa-fw fa-minus"></i>');
                $('#nomeProcedimento').focus();
            } else {
                divCadProc.addClass('hide');
                $('#novoProcedimento').html('<i class="fa fa-fw fa-plus"></i>');
            }
        });

        $('#btnAtualizar').click(function() {
            $('#hcasos').val(null);

            $('#divCasos label').each(function(i, obj) {
                if ($(obj).find('.icheckbox_flat-blue').hasClass('checked')) {

                    var valor = $(this).find(':checkbox').val();
                    //alert(valor);

                    if ($('#hcasos').val() === '') {
                        $('#hcasos').val(valor);
                    } else {
                        $('#hcasos').val($('#hcasos').val() + '-' + valor);
                    }
                }
            });

            if ($('#hcasos').val() === '') {
                alert('Você precisa selecionar pelo menos 1 caso');
                return;
            }

            if ($('#ckbEncerrarChamado').parents('div').hasClass('checked')) {
                $('#hencerrado').val('3');
            } else {
                $('#hencerrado').val(null);
            }

            $('#hprocedimentos').val(null);
            $('.procedimentos li').each(function(i, obj) {
                var valor = $(this).find(':hidden').val();

                if ($('#hprocedimentos').val() === '') {
                    $('#hprocedimentos').val(valor);
                } else {
                    $('#hprocedimentos').val($('#hprocedimentos').val() + '-' + valor);
                }
            });


            $.ajax({
                type: 'POST',
                url: 'atualizarchamado',
                data: {id_chamado: $('#mh_idChamado').val(), casos: $('#hcasos').val(), diagnostico: $('#taDiagnostico').val(), procedimentos: $('#hprocedimentos').val(), encerrado: $('#hencerrado').val()}
            }).done(function(data) {

                switch (data) {
                    case 'UNA':
                        console.log('UNA - Usuário Não Ativo');
                        window.location.replace('');
                        break;
                    case 'SE':
                        console.log('SE - Sessão Expirada');
                        window.location.replace('');
                        break;
                    case 'RPU':
                        console.log('RPU - Requisição Proibida para Usuários');
                        window.location.replace('');
                        break;
                    case 'RPA':
                        console.log('RPA - Requisição Proibida para Administradores');
                        window.location.replace('');
                        break;
                    case 'UFL':
                        console.log('UFL - Usuário Fez Logout');
                        window.location.replace('');
                        break;
                }

                $('#modalChamado').modal('hide');

            }).fail(function(xhr, status, error) {
                alert('Ocorreu um erro com a sua requisição.\nPor favor entre em contato com a TI no ramal 9854.');
                console.log(xhr.responseText);
            });

        });

        $('#taDiagnostico').css('resize', 'none');

        $('.todo-list').on('click', 'i', function() {
            $(this).parents('li').remove();
        });

        $('#sProcedimentos').on('change', function() {
            if ($(this).find(":selected").val() !== '') {
                if ($('.todo-list li:contains("' + $(this).find(":selected").text() + '")').length === 0) { //Se existe o item
                    $('.todo-list').append('<li><input type="hidden" value="' + $(this).find(":selected").val() + '"><span class="text">' + $(this).find(":selected").text() + '</span><div class="tools"><i class="fa fa-times"></i></div></li>');
                }
            }
            $(this).val(null);
        });

        $('.ckbTexto').parent().css('cursor', 'pointer');

        $("input[type='checkbox']").iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            labelHover: true,
            cursor: true
        });
    });
</script>