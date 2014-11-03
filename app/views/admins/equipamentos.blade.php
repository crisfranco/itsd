<div class="row">
    <section class="col-md-9 connectedSortable ui-sortable">
        <div class="box box">
            <div class="box-header">
                <h3 class="box-title">Equipamentos</h3>
                <div class="box-tools pull-right">                    
                    <button class="btn btn-default btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <table id="listaEquipamentos" class="table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Cód.</th>
                            <th>Nome</th>
                            <th>CN</th>                            
                            <th>Marca</th>
                            <th>Categoria</th>
                            <th>Setor</th>
                            <th>Aquisição</th>
                            <th>Garantia</th>                            
                            <th>Ações</th>
                        </tr>
                    </thead>            
                    <tbody>                
                        <?php foreach ( $todas_os_equipamentos as $e ) : ?>
                            <tr>
                                <td><input type="hidden" id="hIdEquip" value="{{ $e->id; }}">{{ $e->id; }}</td>
                                <td>                                    
                                    <?php $cn; ?>
                                    <?php if ( $e->id_categoria == '1' || $e->id_categoria == '2' ) : ?>
                                        <?php
                                        if ( is_null( $e->marca ) )
                                        {
                                            $marcaId = '';
                                            $marcaNome = '';
                                        }
                                        else
                                        {
                                            $marcaId = $e->marca->id;
                                            $marcaNome = $e->marca->nome;
                                        }

                                        if ( is_null( $e->categoria ) )
                                        {
                                            $categoriaId = '';
                                            $categoriaNome = '';
                                        }
                                        else
                                        {
                                            $categoriaId = $e->categoria->id;
                                            $categoriaNome = $e->categoria->nome;
                                        }

                                        if ( is_null( $e->setor ) )
                                        {
                                            $setorId = '';
                                            $setorNome = '';
                                            $setorSigla = '';
                                        }
                                        else
                                        {
                                            $setorId = $e->setor->id;
                                            $setorNome = $e->setor->nome;
                                            $setorSigla = $e->setor->sigla;
                                        }
                                        ?>

                                        <input type='hidden' id='hEquipNome' value='{{ $e->nome }}'>                                        
                                        <input type='hidden' id='hEquipSO' value='{{ $e->so }}'>
                                        <input type='hidden' id='hEquipProcessador' value='{{ $e->processador }}'>
                                        <input type='hidden' id='hEquipMemoria' value='{{ $e->memoria }}'>
                                        <input type='hidden' id='hEquipHD' value='{{ $e->hd }}'>
                                        <input type='hidden' id='hEquipPatrCPU' value='{{ $e->patrimonio_cpu }}'>
                                        <input type='hidden' id='hEquipPatrMonitor' value='{{ $e->patrimonio_monitor }}'>
                                        <input type='hidden' id='hEquipServiceTAG' value='{{ $e->service_tag }}'>

                                        <a href='#' data-toggle='tooltip' data-html='true' title="
                                           SO: <span class='text-yellow'>{{ $e->so }}</span><br/>
                                           Processador: <span id='seProcessador' class='text-yellow'>{{ $e->processador }}</span><br/>
                                           Memória: <span id='seMemoria' class='text-yellow'>{{ $e->memoria }} gb</span><br/>
                                           HD: <span id='seHD' class='text-yellow'>{{ $e->hd }} gb</span><br/>
                                           Patr.-CPU: <span id='sePatrCPU' class='text-yellow'>{{ $e->patrimonio_cpu }}</span><br/>
                                           Patr.-Monitor: <span id='sePatrMonitor' class='text-yellow'>{{ $e->patrimonio_monitor }}</span><br/>
                                           Service TAG: <span id='seServiceTAG' class='text-yellow'>{{ $e->service_tag }}</span>">
                                            {{ $e->nome }}</a>

                                    <?php else : ?>
                                        <input type='hidden' id='hEquipNome' value='{{ $e->nome }}'>
                                        <input type='hidden' id='hEquipPatrimonio' value='{{ $e->patrimonio }}'>
                                        <a href='#' data-toggle='tooltip' data-html='true' title="
                                           Patrimônio: <span id='sePatrimonio' class='text-yellow'>{{ $e->patrimonio }}</span>">
                                            {{ $e->nome }}</a>
                                    <?php endif; ?>
                                </td>
                                <td><input type="hidden" id="hCN" value="{{ $e->cn; }}">{{ $e->cn; }}</td>
                                <td><input type="hidden" id="hMarca" value="{{ $marcaId; }}">{{ $marcaNome; }}</td>
                                <td><input type="hidden" id="hCategoria" value="{{ $categoriaId; }}">{{ $categoriaNome; }}</td>
                                <td>                                    
                                    <input type="hidden" id="hSetor" value="{{ $setorId; }}">                                    
                                    <a href="#" data-toggle="tooltip" title="{{ $setorNome; }}">{{ $setorSigla; }}</a>
                                </td>
                                <td><input type="hidden" id="hDataAquisicao" value="<?php echo date( "d/m/Y", strtotime( $e->dt_aquisicao ) ); ?>"><?php echo date( "d/m/Y", strtotime( $e->dt_aquisicao ) ); ?></td>
                                <td><input type="hidden" id="hDataGarantia" value="<?php echo date( "d/m/Y", strtotime( $e->dt_garantia ) ); ?>"><?php echo date( "d/m/Y", strtotime( $e->dt_garantia ) ); ?></td>                                
                                <td><button id="btnExcluir" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Excluir"><i class="fa fa-eraser"></i></button> <button id="btnEditar" class="btn btn-github btn-xs" data-toggle="tooltip" title="Editar"><i class="fa fa-gears"></i></button></td>
                            </tr>
                        <?php endforeach; ?> 
                    </tbody>            
                </table>
            </div>            
        </div>
    </section>
    <section id="sCadEquipamento" class="col-md-3 connectedSortable ui-sortable">        
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Cadastrar Equip.</h3>
                <div class="box-tools pull-right">                    
                    <button class="btn btn-default btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form id="frmEquipamentos">
                    <p>
                        <select id="sCategorias" name="sCategorias" class="form-control">
                            <option value></option>
                            <?php foreach ( $categorias as $c ) : ?>                            
                                <option value="<?php echo $c->id; ?>"><?php echo $c->nome; ?></option>
                            <?php endforeach; ?> 
                        </select>
                    </p>
                    <p>
                        <select id="sMarcas" name="sMarcas" class="form-control">
                            <option value></option>
                            <?php foreach ( $marcas as $e ) : ?>                            
                                <option value="<?php echo $e->id; ?>"><?php echo $e->nome; ?></option>
                            <?php endforeach; ?> 
                        </select>
                    </p>
                    <p>
                        <select id="sSetores" name="sSetores" class="form-control">
                            <option value></option>
                            <?php foreach ( $setores as $s ) : ?>                            
                                <option value="<?php echo $s->id; ?>"><?php echo $s->nome; ?></option>
                            <?php endforeach; ?> 
                        </select>
                    </p>
                    <p>
                        <input id="equipNome" name="equipNome" class="form-control input-lg floatlabel" type="text" placeholder="Equipamento">
                    </p>
                    <div id="ttEquip">
                        <p>
                            <input id="equipCN" name="equipCN" class="form-control input-lg floatlabel" type="text" placeholder="Cód. CN">
                        </p>
                        <p>
                            <input id="equipSO" name="equipSO" class="form-control input-lg floatlabel" type="text" placeholder="Sistema Operacional">
                        </p>
                        <p>
                            <input id="equipProcessador" name="equipProcessador" class="form-control input-lg floatlabel" type="text" placeholder="Processador">
                        </p>
                        <p>
                            <input id="equipMemoria" name="equipMemoria" class="form-control input-lg floatlabel" type="text" placeholder="Memória(gb)">
                        </p>
                        <p>
                            <input id="equipHD" name="equipHD" class="form-control input-lg floatlabel" type="text" placeholder="HD(gb)">
                        </p>
                        <p>
                            <input id="equipPatrimonioCPU" name="equipPatrimonioCPU" class="form-control input-lg floatlabel" type="text" placeholder="Patrimônio CPU">
                        </p>
                        <p>
                            <input id="equipPatrimonioMonitor" name="equipPatrimonioMonitor" class="form-control input-lg floatlabel" type="text" placeholder="Patrimônio Monitor">
                        </p>
                        <p>
                            <input id="equipST" name="equipST" class="form-control input-lg floatlabel" type="text" placeholder="Service Tag">
                        </p>
                    </div>                    
                    <p>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="equipDataAquisicao" name="equipDataAquisicao" placeholder="Data da aquisição" type="text" class="form-control">
                    </div>
                    </p>
                    <p>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="equipDataGarantia" name="equipDataGarantia" placeholder="Data da garantia" type="text" class="form-control">
                    </div>
                    </p>                    
                    <p>
                        <input id="equipPatrimonio" name="equipPatrimonio" class="form-control input-lg floatlabel" type="text" placeholder="Patrimônio">
                    </p>
                </form>
            </div>
            <div class="box-footer text-right">
                <button id="btnCadEquipamento" type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>        
    </section>
    <section id="sEditEquipamento" class="col-md-3 connectedSortable ui-sortable">        
        <div class="box box-warning">
            <div class="box-header">
                <h3 class="box-title">Editar Equip.</h3>
                <div class="box-tools pull-right">
                    <button id="btnSEditHide" class="btn btn-default btn-xs"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form id="frmEditEquipamentos">
                    <input type="hidden" id="idEquip" name="idEquip" value>
                    <p>Cód.: <code id="codEquip"></code></p>
                    <p>
                        <select id="eSCategorias" name="eSCategorias" class="form-control">                            
                            <?php foreach ( $categorias as $c ) : ?>                            
                                <option value="<?php echo $c->id; ?>"><?php echo $c->nome; ?></option>
                            <?php endforeach; ?> 
                        </select>
                    </p>
                    <p>
                        <select id="eSMarcas" name="eSMarcas" class="form-control">                            
                            <?php foreach ( $marcas as $e ) : ?>                            
                                <option value="<?php echo $e->id; ?>"><?php echo $e->nome; ?></option>
                            <?php endforeach; ?> 
                        </select>
                    </p>
                    <p>
                        <select id="eSSetores" name="eSSetores" class="form-control">                            
                            <?php foreach ( $setores as $s ) : ?>                            
                                <option value="<?php echo $s->id; ?>"><?php echo $s->nome; ?></option>
                            <?php endforeach; ?> 
                        </select>
                    </p>
                    <p>
                        <input id="eEquipNome" name="eEquipNome" class="form-control input-lg floatlabel" type="text" placeholder="Equipamento">
                    </p>
                    <div id="tteEquip">
                        <p>
                            <input id="eEquipCN" name="eEquipCN" class="form-control input-lg floatlabel" type="text" placeholder="Cód. CN">
                        </p>
                        <p>
                            <input id="eEquipSO" name="eEquipSO" class="form-control input-lg floatlabel" type="text" placeholder="Sistema Operacional">
                        </p>

                        <p>
                            <input id="eEquipProcessador" name="eEquipProcessador" class="form-control input-lg floatlabel" type="text" placeholder="Processador">
                        </p>
                        <p>
                            <input id="eEquipMemoria" name="eEquipMemoria" class="form-control input-lg floatlabel" type="text" placeholder="Memória(gb)">
                        </p>
                        <p>
                            <input id="eEquipHD" name="eEquipHD" class="form-control input-lg floatlabel" type="text" placeholder="HD(gb)">
                        </p>
                        <p>
                            <input id="eEquipPatrimonioCPU" name="eEquipPatrimonioCPU" class="form-control input-lg floatlabel" type="text" placeholder="Patrimônio CPU">
                        </p>
                        <p>
                            <input id="eEquipPatrimonioMonitor" name="eEquipPatrimonioMonitor" class="form-control input-lg floatlabel" type="text" placeholder="Patrimônio Monitor">
                        </p>
                        <p>
                            <input id="eEquipST" name="eEquipST" class="form-control input-lg floatlabel" type="text" placeholder="Service Tag">
                        </p>
                    </div>
                    <p>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="eEquipDataAquisicao" name="eEquipDataAquisicao" placeholder="Data da aquisição" type="text" class="form-control">
                    </div>
                    </p>
                    <p>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="eEquipDataGarantia" name="eEquipDataGarantia" placeholder="Data da garantia" type="text" class="form-control">
                    </div>
                    </p>                    
                    <p>
                        <input id="eEquipPatrimonio" name="eEquipPatrimonio" class="form-control input-lg floatlabel" type="text" placeholder="Patrimônio">
                    </p>
                </form>
            </div>
            <div class="box-footer text-right">
                <button id="btnEditEquipamento" type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </div>        
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('a').click(function(e) {
            e.preventDefault();
        });
        $('.content-header h1').html('Equipamentos <small>gerenciamento</small>');
        $('#sEditEquipamento').hide(0);
        $('#ttEquip, #tteEquip').hide(0);
        $('#sCategorias').focus();

        $('#equipDataAquisicao, #equipDataGarantia, #eEquipDataAquisicao, #eEquipDataGarantia').datepicker({
            format: "dd/mm/yyyy",
            language: "pt-BR",
            autoclose: true,
            todayHighlight: true
        });

        $('#sCategorias').on('change', function() {
            if ($(this).val() === '1' || $(this).val() === '2') {
                $('#equipPatrimonio').parent().stop().hide(300, 'easeOutBack');
                $('#ttEquip').stop().show(300, 'easeOutBack');
            } else {
                $('#ttEquip').stop().hide(300, 'easeInBack');
                $('#equipPatrimonio').parent().stop().show(300, 'easeOutBack');
            }
        });

        $('#eSCategorias').on('change', function() {
            if ($(this).val() === '1' || $(this).val() === '2') {
                $('#eEquipPatrimonio').parent().stop().hide(300, 'easeOutBack');
                $('#tteEquip').stop().show(300, 'easeOutBack');
            } else {
                $('#tteEquip').stop().hide(300, 'easeInBack');
                $('#eEquipPatrimonio').parent().stop().show(300, 'easeOutBack');
            }
        });

        $('form').submit(function(e) {
            e.preventDefault();
        });

        $('#btnCadEquipamento').click(function(e) {
            e.preventDefault();
            $.loadPage('cadequipamento', 'post', $('#frmEquipamentos').serialize());
            $('#sCadCategoria').focus();
        });

        $('#btnEditEquipamento').click(function() {
            $.loadPage('editequipamento', 'post', $('#frmEditEquipamentos').serialize());
        });

        //verificar aqui depois... #################################
        $('#modNome, #eModNome').keydown(function(e) {
            if (e.keyCode === 13) {
                e.preventDefault();

                if ($(this).attr('id') === 'modNome') {
                    $('#btnCadEquipamento').trigger('click');
                } else if ($(this).attr('id') === 'eModNome') {
                    $('#btnEditEquipamento').trigger('click');
                }
            }
        });
        //FIM ######################################################

        $('#btnSEditHide').click(function() {
            $('#sEditEquipamento').hide(0);
            $('#codMod').html('');
            $('#sCadEquipamento').show(200);
        });

        $('#listaEquipamentos button').click(function() {

            if ($(this).attr('id') === 'btnExcluir')
            {
                var idEquipamento = $(this).parents("tr").find("#hIdEquip").val();

                var postData = {id: idEquipamento};

                $.loadPage('excequipamento', 'post', postData);
            }

            else if ($(this).attr('id') === 'btnEditar')
            {
                var sEdit = $('#sEditEquipamento');
                var sCad = $('#sCadEquipamento');

                var codEquip = $(this).parents("tr").find("#hIdEquip").val();
                $('#codEquip').html(codEquip);
                $('#idEquip').val(codEquip);

                //MARCA
                var marSelecionada = $(this).parents("tr").find("#hMarca").val();
                $('#eSMarcas').val(marSelecionada);

                //SETOR
                var setorSelecionado = $(this).parents("tr").find("#hSetor").val();
                $('#eSSetores').val(setorSelecionado);

                //DATA DA AQUISIÇÃO
                var dtAquisicao = $(this).parents("tr").find("#hDataAquisicao").val();
                $('#eEquipDataAquisicao').val(dtAquisicao);
                $('#eEquipDataAquisicao').datepicker('update');

                //DATA DA AQUISIÇÃO
                var dtGarantia = $(this).parents("tr").find("#hDataGarantia").val();
                $('#eEquipDataGarantia').val(dtGarantia);
                $('#eEquipDataGarantia').datepicker('update');

                //SERVICE TAG
                var ST = $(this).parents("tr").find("#hEquipServiceTAG").val();
                $('#eEquipST').val(ST);

                //NOME
                var equipNome = $(this).parents("tr").find("#hEquipNome").val();
                $('#eEquipNome').val(equipNome);

                //CN
                var equipCN = $(this).parents("tr").find("#hCN").val();
                $('#eEquipCN').val(equipCN);

                //SO
                var equipSO = $(this).parents("tr").find("#hEquipSO").val();
                $('#eEquipSO').val(equipSO);

                //PROCESSADOR
                var equipProcessador = $(this).parents("tr").find("#hEquipProcessador").val();
                $('#eEquipProcessador').val(equipProcessador);

                //MEMÓRIA
                var equipMemoria = $(this).parents("tr").find("#hEquipMemoria").val();
                $('#eEquipMemoria').val(equipMemoria);

                //HD
                var equipHD = $(this).parents("tr").find("#hEquipHD").val();
                $('#eEquipHD').val(equipHD);

                //PATRIMONIO_CPU
                var equipPatCPU = $(this).parents("tr").find("#hEquipPatrCPU").val();
                $('#eEquipPatrimonioCPU').val(equipPatCPU);

                //PATRIMONIO_MONITOR
                var equipPatMonitor = $(this).parents("tr").find("#hEquipPatrMonitor").val();
                $('#eEquipPatrimonioMonitor').val(equipPatMonitor);

                //PATRIMONIO
                var equipPatrimonio = $(this).parents("tr").find("#hEquipPatrimonio").val();
                $('#eEquipPatrimonio').val(equipPatrimonio);

                if (sEdit.css('display') === 'none') {
                    sCad.hide(0);
                    sEdit.show(200);
                }

                //CATEGORIA
                var catSelecionada = $(this).parents("tr").find("#hCategoria").val();
                $('#eSCategorias').val(catSelecionada);

                if ($('#eSCategorias').val() === '1' || $('#eSCategorias').val() === '2') {
                    $('#eEquipPatrimonio').parent().stop().hide(300, 'easeOutBack');
                    $('#tteEquip').stop().show(300, 'easeOutBack');
                } else {
                    $('#tteEquip').stop().hide(300, 'easeInBack');
                    $('#eEquipPatrimonio').parent().stop().show(300, 'easeOutBack');
                }

                $('#eEquipNome, #eEquipCN, #eEquipSO, #eEquipProcessador, #eEquipMemoria, #eEquipHD, #eEquipPatrimonioCPU, #eEquipPatrimonioMonitor, #eEquipST, #eEquipPatrimonio ').blur();

                $('#eSCategorias').blur().focus();
            }
        });

        $('#listaEquipamentos').dataTable({
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
            ],
            "aLengthMenu": [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "Todos"]
           ],
            "iDisplayLength": 25
        });
    });

</script>