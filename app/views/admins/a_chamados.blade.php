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
    <section id="sListaChamadosAbertos" class="col-md-12 connectedSortable ui-sortable">
        <div class="box box">
            <div class="box-header">
                <i class="fa  fa-list-alt"></i>
                <h3 class="box-title">Chamados</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <table id="chamadosAbertos" class="table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Cód.</th>
                            <th>Ocorrência</th>                            
                            <th>Usuário</th>
                            <th>Ramal</th>
                            <th>Descrição</th>
                            <th>Data/Hora</th>
                            <th>Prior.</th>
                            <th>Atendendo</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($chamados_abertos as $c) : ?>
                            <tr>
                                <td>
                                    {{ $c->id; }}
                                    <input type="hidden" id="hIdChamado" name="hIdChamado" value="{{ $c->id; }}">
                                </td>
                                <td>
                                    <span class="text-muted">{{ $c->helperCategoria->helper->nome; }}</span><br/>
                                    {{ $c->helperCategoria->nome; }}
                                    <input type="hidden" id="hHelperNome" name="hHelperNome" value="{{ $c->helperCategoria->helper->nome; }}">
                                    <input type="hidden" id="hHelperCategoriaNome" name="hHelperCategoriaNome" value="{{ $c->helperCategoria->nome; }}">
                                </td>
                                <td>
                                    <span class="text-muted">{{ $c->usuarioAtendido->equipamento->cn; }}</span><br />
                                    {{ $c->usuarioAtendido->nome; }}
                                    <input type="hidden" id="hCN" name="hCN" value="{{ $c->usuarioAtendido->equipamento->cn; }}">
                                    <input type="hidden" id="hUsuarioNome" name="hUsuarioNome" value="{{ $c->usuarioAtendido->nome; }}">
                                </td>
                                <td>
                                    {{ $c->usuarioAtendido->ramal; }}
                                    <input type="hidden" id="hRamal" name="hRamal" value="{{ $c->usuarioAtendido->ramal; }}">
                                </td>
                                <td>
                                    {{ $c->texto; }}
                                    <input type="hidden" id="hTexto" name="hTexto" value="{{ $c->texto; }}">
                                </td>
                                <td>                                    
                                    <?php echo date('d.m.Y H:i:s', strtotime($c->dt_abertura)); ?>
                                    <input type="hidden" id="hDataChamado" name="hDataChamado" value="{{ $c->dt_abertura; }}">
                                </td>
                                <td>
                                    {{ $c->prioridade; }}
                                    <input type="hidden" id="hPrioridade" name="hPrioridade" value="{{ $c->prioridade; }}">
                                </td>
                                <td>
                                    <?php echo (!is_null($c->atendido_por) ? Usuarios::find($c->atendido_por)->nome : '-'); ?>                                    
                                    <input type="hidden" id="hAtendidoPor" name="hAtendidoPor" value="{{ $c->atendido_por; }}">                                    
                                </td>
                                <td>
                                    {{ $c->status->nome; }}
                                    <input type="hidden" id="hStatus" name="hStatus" value="{{ $c->status->nome; }}">
                                </td>
                                <td>
                                    <button id="btnAtenderChamado" href="#" class="btn bg-olive btn-flat">
                                        <i class="fa fa-cogs"></i>
                                    </button>
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

        $('.lChamados small').text('{{ $chamados_abertos->count(); }}');

        $('.content-header h1').html('Chamados <small>gerenciamento</small>');

        $('#modalChamado').on('hidden.bs.modal', function (e) {
            limparModal();
            $('.lChamados').click();
        });

        $('#chamadosAbertos button').on('click', function () {
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

        $('#chamadosAbertos a').on('click', function () {
            e.preventDefault();
        });

        $('#chamadosAbertos').dataTable({
            "order": [[6, "desc"]],
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
            },
            aoColumnDefs: [//Desabilitando o sorting para a última coluna (Ações)
                {
                    bSortable: false,
                    aTargets: [-1]
                }
            ]
        });        
    });

</script>

