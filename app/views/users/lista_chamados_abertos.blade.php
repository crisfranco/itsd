<table id="chamadosAbertos" class="table-responsive table-hover">
    <thead>
        <tr>
            <th>Cód.</th>                            
            <th>Ocorrência</th>
            <th>Detalhes</th>
            <th>Data/Hora</th>
            <th>Status</th>
            <th>Diagnóstico</th>
            <th>Procedimentos</th>           
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($chamados_abertos as $c) : ?>
            <tr>
                <td>{{ $c->id; }}</td>
                <td>
                    <span class="text-muted">{{ $c->helperCategoria->helper->nome; }}</span><br/>
                    {{ $c->helperCategoria->nome; }}
                </td>
                <td>{{ $c->texto; }}</td>
                <td><?php echo gmdate('d.m.Y', strtotime($c->dt_abertura)), '<br/>', gmdate('H:i:s', strtotime($c->dt_abertura)); ?></td>
                <td><?php echo (!is_null($c->status) ? $c->status->nome : '-'); ?></td>
                <td>{{ $c->diagnostico; }}</td>
                <td>
                    <ul>
                        <?php foreach ($c->servico as $s) : ?>
                            <li>{{ $s->procedimento->nome; }}</li>
                        <?php endforeach; ?> 
                    </ul>
                </td>
                <td>
                    <?php if ($c->id_status === 1) : ?>
                        <button id="btnExcluir" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Excluir"><i class="fa fa-eraser"></i></button>
                        <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?> 
    </tbody>            
</table>

<script type="text/javascript">
    $(function () {

        $('#chamadosAbertos button').on('click', function () {

            if ($(this).attr('id') === 'btnExcluir')
            {
                $(this).attr("disabled", "disabled");

                var idChamado = $(this).parent().siblings("td:first").text();
                var postData = {idC: idChamado};

                $.ajax({
                    type: 'post',
                    url: 'excchamado',
                    data: {idC: idChamado}
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

                }).fail(function (xhr, status, error) {
                    alert('Ocorreu um erro com a sua requisição.\nPor favor entre em contato com a TI no ramal 9854.');
                    $(this).removeAttr('disabled');
                    console.log(xhr.responseText);
                });
            }
        });
    });
</script>