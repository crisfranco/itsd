<style>
    .invisivel{
        display: none;
    }

    #detalhamento{
        -webkit-animation-duration: 0.05s;
        -moz-animation-duration: 0.05s;
    }

    #detalhamento textArea{
        min-height: 100px;
        resize: none;
    }
</style>
<!--<a href="#" id="linkEmail">Enviar email</a>-->
<div class="row">
    <section id="sListaChamadosAbertos" class="col-md-9 connectedSortable ui-sortable">        
        <div class="box box">
            <div class="box-header">
                <i class="fa  fa-list-alt"></i>
                <h3 class="box-title">Chamados</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Abertos</a></li>
                        <li><a id="tabFechados" href="#tab_2" data-toggle="tab">Fechados</a></li>                
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">                    
                            @include('users.lista_chamados_abertos')
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            @include('users.lista_chamados_fechados')
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div>
            </div>            
        </div>
    </section>

    <section id="sCadChamado" class="col-md-3 connectedSortable ui-sortable">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-warning"></i>
                <h3 class="box-title">Abrir Chamado</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <form id="frmAbrirChamados">
                    <div id="listaHelpers" class="list-group">
                        <?php foreach ($helpers as $h) : ?>
                            <a href="#" class="list-group-item">
                                {{ $h->nome; }}
                                <input type="hidden" value="{{ $h->id; }}">
                            </a>
                        <?php endforeach; ?>
                        <input type="hidden" id="idHelper" name="idHelper" value="">
                    </div>
                    <div id="detalhamento" class="invisivel">
                        <h6 class="page-header"><small>Detalhes</small></h6>
                        <div id="subOpcoes">
                            <p>
                                <label for="prioridadeMaxima">
                                    <input type="checkbox" name="prioridadeMaxima" id="prioridadeMaxima" >
                                    <span id="pmTexto"></span>
                                </label>
                                <input type="hidden" id="ckP" name="ckP" value="23">
                            </p>
                            <p>
                                <label for="sSubCategorias">Mais opções</label>
                                <select id="sSubCategorias" name="sSubCategorias" class="form-control input-lg"></select>
                            </p>
                        </div>
                        <p>
                            <label for="sSubCategorias">Descrição</label>
                            <textarea id="info" name="info" class="form-control" placeholder="Mínimo de 10 letras"></textarea>
                        <p>
                    </div>
                </form>
            </div>
            <div class="box-footer text-right">
                <button id="btnCadChamado" type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>        
    </section>    
</div>
<script type="text/javascript">

    function atualizarChamados() {
        setInterval(function () {
            $.ajax({
                type: 'get',
                url: 'gchamadosabertos'
            }).done(function (data) {

                switch (data) {
                    case 'SE':
                        console.log('SE - Sessão Expirada');
                        window.location.replace('');
                        return;
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

                $('#tab_1').html(data);

                console.log(new Date());

                configurarTabela('chamadosAbertos');

            }).fail(function (xhr, status, error) {
                console.log(xhr.responseText);
                alert('Ocorreu um erro com sua requisição. Por favor, contate a TI no ramal 9854.');
            });
        }, 30000);
    }

    atualizarChamados();

    function enviarEmail() {
        $.ajax({
            type: 'POST',
            url: 'enviaremail',
            data: {dados: ''}
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

        }).fail(function (xhr, status, error) {
            console.log(xhr.responseText);
            alert('Ocorreu um erro com sua requisição. Por favor, contate a TI no ramal 9854.');
        });
    }

    $('#linkEmail').click(function (e) {
        enviarEmail();
    });

    $(function () {

        $('#tabFechados').click(function (e) {
            e.preventDefault;
            $.ajax({
                type: 'get',
                url: 'gchamadosfechados'
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

                $('#tab_2').html(data);

                console.log(new Date());

                configurarTabela('chamadosFechados');

            }).fail(function (xhr, status, error) {
                console.log(xhr.responseText);
                alert('Ocorreu um erro com sua requisição. Por favor, contate a TI no ramal 9854.');
            });
        });

        //MANTER O SELECT ABERTO QUANDO A REQUISIÇÃO AJAX RETORNA
        $("#sSubCategorias.active").toggleClass("open", true);
        $("#sSubCategorias.active").on("hide.bs.dropdown", function (e) {
            e.preventDefault();
            return false;
        });//FIM

        $('#btnCadChamado').prop('disabled', true);

        var subCategorias = $('#sSubCategorias');

        $('#prioridadeMaxima').on('ifChecked', function () {
            subCategorias.val(null);
            subCategorias.prop('disabled', true);
            $('#prioridadeMaxima').prop('checked', true);
            $('#btnCadChamado').prop('disabled', false);
        });

        $('#prioridadeMaxima').on('ifUnchecked', function () {
            subCategorias.prop('disabled', false);
            $('#prioridadeMaxima').prop('checked', false);
            $('#btnCadChamado').prop('disabled', true);
        });

        $('#sSubCategorias').on('change', function () {
            if ($(this).val() === '') {
                $('#btnCadChamado').prop('disabled', true);
            } else {
                $('#btnCadChamado').prop('disabled', false);
            }
        });

        $('#pmTexto').parent().css('cursor', 'pointer');

        //Cadastrar um chamado
        $('#btnCadChamado').on('click', function () {

            if ($('#info').val().trim().length < 10) {
                //if ($('.icheckbox_flat-red').hasClass('checked') === false) {
                var controle = $('#info');
                alert(controle.attr("placeholder") + " requeridas");
                controle.focus();
                return;
                //}
            }
            
            $("#btnCadChamado").attr("disabled", "disabled");
            $.loadPage('cadchamadou', 'post', $('#frmAbrirChamados').serialize());
        });

        $('#prioridadeMaxima').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            labelHover: true,
            cursor: true
        });

        $('a').on('click', function (e) {
            e.preventDefault();
        });

        var animIn = 'fadeInDown';
        var animOut = 'fadeOutUp';
        var divDet = $('#detalhamento');

        $('#listaHelpers a').on('click', function () {

            if ($(this).hasClass('active')) {
                return;
            }

            $('#listaHelpers a').removeClass('active');

            $(this).addClass('active animated flipInX').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                $(this).removeClass('flipInX');
            });

            //Animação de ocultar
            if (divDet.hasClass('invisivel') === false) {
                divDet.removeClass('animated ' + animIn).addClass('animated ' + animOut).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                    $('#prioridadeMaxima').iCheck('uncheck');

                    ajaxHelpers();
                });
            } else {
                ajaxHelpers();
            }
        });

        var idHelperSelecionado = 0;
        function ajaxHelpers() {
            //Iniciando a requisição das SubCategorias
            idHelperSelecionado = $('#listaHelpers a.active input').val();

            console.log(idHelperSelecionado + " |");

            //Se escolher a opção 'Outros', esconde os controles
            if ($('#listaHelpers a.active input').val() === '7') {
                $('#subOpcoes').addClass('invisivel');
                $('#btnCadChamado').prop('disabled', false);
            } else {
                $('#subOpcoes').removeClass('invisivel');
                $('#btnCadChamado').prop('disabled', true);
            }

            $('#idHelper').val(idHelperSelecionado);
            $.getJSON('cathelpers', {id: idHelperSelecionado}, function (data) {

                var categorias = $('#sSubCategorias');
                categorias.find('option').remove().end().append('<option value></option>');

                $.each(data, function (i) {
                    if (data[i]['prioridade'] === 3) {
                        $('#pmTexto').text(data[i]['nome']);
                        $('#ckP').val(data[i]['id']);
                    } else {
                        categorias.append('<option value="' + data[i]['id'] + '">' + data[i]['nome'] + '</option>');
                    }
                });

            }).done(function () {

                //Iniciando a animação de aparecer
                if (divDet.hasClass('invisivel')) {
                    divDet.removeClass('invisivel').addClass('animated ' + animIn);
                } else {
                    divDet.removeClass('animated ' + animOut).addClass('animated ' + animIn).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                        //                       
                    });
                }

            }).fail(function (xhr, ajaxOptions, thrownError) {
                //Iniciando a animação de aparecer
                if (xhr.responseText === 'SE') {
                    window.location.replace('/');
                    return;
                } else {
                    console.log(xhr.responseText);
                    divDet.html('<h4>Não foi possível completar a requisição</h4>');
                    divDet.removeClass('invisivel ' + animOut).addClass('animated ' + animIn);
                }
            });
        }
        configurarTabela('chamadosAbertos');
        configurarTabela('chamadosFechados');
    });

    function configurarTabela(div) {
        var elemento = '#' + div;
        if (elemento === '#chamadosFechados') {
            $(elemento).dataTable({
                "order": [[0, "desc"]],
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
        } else {
            $(elemento).dataTable({
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
        }
    }
</script>