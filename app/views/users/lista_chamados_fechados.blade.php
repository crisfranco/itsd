<table id="chamadosFechados" class="table-responsive table-hover">
    <thead>
        <tr>
            <th>Cód.</th>                            
            <th>Ocorrência</th>
            <th>Detalhes</th>
            <th>Data/Hora</th>            
            <th>Encerrado em</th>
            <th>Diagnóstico</th>
            <th>Procedimentos</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($chamados_fechados as $c) : ?>
            <tr>
                <td>{{ $c->id; }}</td>
                <td>
                    <span class="text-muted">{{ $c->helperCategoria->helper->nome; }}</span><br/>
                    {{ $c->helperCategoria->nome; }}
                </td>
                <td>{{ $c->texto; }}</td>
                <td><?php echo gmdate('d.m.Y', strtotime($c->dt_abertura)), '<br/>', gmdate('H:i:s', strtotime($c->dt_abertura)); ?></td>                
                <td><?php echo gmdate('d.m.Y', strtotime($c->dt_fechamento)); ?></td>
                <td>{{ $c->diagnostico; }}</td>
                <td>
                    <ul>
                        <?php foreach ($c->servico as $s) : ?>
                            <li>{{ $s->procedimento->nome; }}</li>
                        <?php endforeach; ?> 
                    </ul>
                </td>
                <td>
                    <?php
                    $data_fechamento = new DateTime(date('Y-m-d', strtotime($c->dt_fechamento)));
                    $data_atual = new DateTime();
                    $periodo = $data_fechamento->diff($data_atual)->days;
                    ?>
                    <?php if (($periodo <= 7) && ($c->reaberto == 0)) : ?>                    
                        <button id="btnReabrir" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Reabrir"><i class="fa  fa-caret-square-o-left"></i></button>
                    <?php endif; ?>                        
                </td>
            </tr>
        <?php endforeach; ?> 
    </tbody>            
</table>

<div class="modal fade" id="mReabrir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Reabrir o Chamado</h4>
            </div>
            <div class="modal-body">
                <form id="formReabrir">
                    <input type="hidden" id="hIdChamado" name="hIdChamado" value="">
                    <textarea id="novaMensagem" name="novaMensagem" class="form-control" rows="5" style="resize: none;" placeholder="Motivo da reabertura"></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnReabrirChamado" class="btn btn-primary">Reabrir</button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

    $(function () {

        $('#btnReabrirChamado').on('click', function () {

            $("#btnReabrirChamado").attr("disabled", "disabled");
            //$.loadPage('reabrirchamado', 'post', $('#formReabrir').serialize());


            $.ajax({
                type: 'post',
                url: 'reabrirchamado',
                data: $('#formReabrir').serialize()
            }).done(function (data) {

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
                    default :
                        console.log(data);
                }

                window.location.replace('');

            }).fail(function (xhr, status, error) {
                alert('Ocorreu um erro com a sua requisição.\nPor favor entre em contato com a TI no ramal 9854.');
                $(this).removeAttr('disabled');
                console.log(xhr.responseText);
                $("#btnReabrirChamado").attr("disabled", "enabled");
            });
        });

        $('#chamadosFechados button').on('click', function () {

            var idChamado = $(this).parent().siblings("td:first").text();

            $('#mReabrir h4').html('Reabrir o Chamado <code>' + idChamado + '</code>');

            $('#hIdChamado').val(idChamado);

            $('#mReabrir').modal('show');

            //var postData = {id: idChamado};
            //$.loadPage('excmarca', 'post', postData);

        });
    });

</script>

