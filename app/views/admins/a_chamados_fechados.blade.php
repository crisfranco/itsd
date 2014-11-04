<style>
    #tabelaAtendimentoChamaods{
        margin-bottom: 0px !important;        
    }

    .modal-footer{
        margin-top: 0px !important;
    }

    #tabDetalhes td{
        vertical-align: top;
        padding: 7px;
    }
</style>
<div class="row">
    <section id="sListaChamadosFechados" class="col-md-12 connectedSortable ui-sortable">
        <div class="box box">
            <div class="box-header">
                <i class="fa  fa-list-alt"></i>
                <h3 class="box-title">Chamados Fechados</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <table id="chamadosFechados" class="table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Cód.</th>
                            <th>Usuário</th>
                            <th>Reclamado</th>
                            <th>Relato</th>                            
                            <th>Ocorrido</th>
                            <th>Procedimentos</th>
                            <th>Diagnóstico</th>
                            <th>Atendente</th>
                            <th>Abertura</th>
                            <th>Fechamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($chamados_fechados as $c) : ?>
                            <tr>
                                <td>{{ $c->id; }}</td>
                                <td>
                                    <span class="text-muted">{{ $c->usuarioAtendido->equipamento->cn; }}</span><br />
                                    {{ $c->usuarioAtendido->nome; }}
                                    <input type="hidden" id="hCN" name="hCN" value="{{ $c->usuarioAtendido->equipamento->cn; }}">
                                    <input type="hidden" id="hUsuarioNome" name="hUsuarioNome" value="{{ $c->usuarioAtendido->nome; }}">
                                </td>                                
                                <td>
                                    <span class="text-muted">{{ $c->helperCategoria->helper->nome; }}</span><br/>
                                    {{ $c->helperCategoria->nome; }}
                                </td>
                                <td>{{ $c->texto; }}</td>
                                <td>
                                    <?php foreach ($c->chamadoCaso as $cc) : ?>
                                        <p>{{ $cc->caso->nome; }}</p>
                                    <?php endforeach; ?>
                                </td>
                                <td>
                                    <ul>
                                        <?php foreach ($c->servico as $s) : ?>
                                            <li>{{ $s->procedimento->nome; }}</li>
                                        <?php endforeach; ?> 
                                    </ul>
                                </td>
                                <td>{{ $c->diagnostico; }}</td>   
                                <td>
                                    <?php echo (!is_null($c->atendido_por) ? Usuarios::find($c->atendido_por)->nome : '-'); ?>                                    
                                    <input type="hidden" id="hAtendidoPor" name="hAtendidoPor" value="{{ $c->atendido_por; }}">                                    
                                </td>
                                <td>                                
                                <?php echo date('Y.m.d H:i:s', strtotime($c->dt_abertura)); ?>
                                </td>                                
                                <td>                                
                                <?php echo date('Y.m.d H:i:s', strtotime($c->dt_fechamento)); ?>
                                </td>
                                                                                           
                            </tr>
                        <?php endforeach; ?> 
                    </tbody>            
                </table>                
            </div>
        </div>
    </section>
</div>
<div id="modalChamado" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    @include('admins.modal_chamados')
</div>
<script type="text/javascript">

    function limparModal() {
        $("#modalChamado input[type='checkbox']").iCheck('uncheck');
        $('#sProcedimentos').val(null);
        $('#taDiagnostico').val(null);
    }

    $(function () {

        $('.lChamadosFechados small').text('{{ $chamados_fechados->count(); }}');

        $('.content-header h1').html('Chamados <small>histórico</small>');

        $('#modalChamado').on('hidden.bs.modal', function (e) {
            limparModal();
            $('.lChamados').click();
        });

        $('#chamadosFechados button').on('click', function () {
            var idChamado = $(this).parents("tr").find("#hIdChamado").val();

            $.ajax({
                type: 'get',
                url: 'getdadoschamado',
                data: {id: idChamado}
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

                $('#modalChamado').html(data);

                $('#modalChamado').modal({
                    keyboard: false,
                    backdrop: 'static'
                });

            }).fail(function (xhr, status, error) {
                console.log(xhr.responseText);
                alert('Ocorreu um erro com sua requisição. Por favor, contate a TI no ramal 9854.');
            });
        });

        $('#chamadosFechados a').on('click', function () {
            e.preventDefault();
        });

        var oTable = $('#chamadosFechados').dataTable({
            "order": [[9, "desc"]],
            "language": {
                "sProcessing": "Processando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "Não foram encontrados resultados",
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
            }
        });
    });

</script>

