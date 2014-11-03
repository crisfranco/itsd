<div class="row">
    <section class="col-md-5 connectedSortable ui-sortable">
        <div class="box box">
            <div class="box-header">
                <h3 class="box-title">Categorias</h3>
                <div class="box-tools pull-right">                    
                    <button class="btn btn-default btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <table id="listaCategorias" class="table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Cód.</th>
                            <th>Nome</th> 
                            <th>Ações</th> 
                        </tr>
                    </thead>            
                    <tbody>                
                        <?php foreach ( $todas_as_categorias as $c ) : ?>
                            <tr>
                                <td><?php echo $c->id; ?></td>
                                <td><?php echo $c->nome; ?></td>                             
                                <td><button id="btnExcluir" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Excluir"><i class="fa fa-eraser"></i></button> <button id="btnEditar" class="btn btn-github btn-xs" data-toggle="tooltip" title="Editar"><i class="fa fa-gears"></i></button></td>
                            </tr>
                        <?php endforeach; ?> 
                    </tbody>            
                </table>
            </div>
            <!--            <div class="box-footer">
                            Registros: <code>{{$todas_as_categorias->count();}}</code>
                        </div>-->
        </div>
    </section>
    <section id="sCadCategoria" class="col-md-3 connectedSortable ui-sortable">        
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Cadastrar Categoria</h3>
                <div class="box-tools pull-right">                    
                    <button class="btn btn-default btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form id="frmCategorias">
                    <input id="cNome" name="cNome" class="form-control input-lg floatlabel" type="text" placeholder="Categoria">
                </form>
            </div>
            <div class="box-footer text-right">
                <button id="btnCadCategoria" type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>        
    </section>
    <section id="sEditCategoria" class="col-md-3 connectedSortable ui-sortable">        
        <div class="box box-warning">
            <div class="box-header">
                <h3 class="box-title">Editar Categoria</h3>
                <div class="box-tools pull-right">                    
                    <button id="btnSEditHide" class="btn btn-default btn-xs"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form id="frmEditCategorias">
                    <p>Cód.: <code id="codC"></code></p>
                    <input id="eCNome" name="cNome" class="form-control input-lg floatlabel" type="text" placeholder="Categoria">
                </form>
            </div>
            <div class="box-footer text-right">
                <button id="btnEditCategoria" type="submit" class="btn btn-primary">Editar</button>
            </div>
        </div>        
    </section>
</div>
<script type="text/javascript">
    $(function() {
        $('.content-header h1').html('Categorias <small>gerenciamento</small>');
        $('#sEditCategoria').hide(0);

        $('#frmCategorias').submit(function(e) {
            e.preventDefault();
        });

        $('#btnCadCategoria').on('click', function(e) {
            e.preventDefault();
            $.loadPage('cadcategoria', 'post', $('#frmCategorias').serialize());
        });

        $('#cNome, #eCNome').keydown(function(e) {
            if (e.keyCode === 13) {
                e.preventDefault();

                if ($(this).attr('id') === 'cNome') {
                    $('#btnCadCategoria').trigger('click');
                } else if ($(this).attr('id') === 'eCNome') {
                    $('#btnEditCategoria').trigger('click');
                }
            }
        });

        $('#btnSEditHide').on('click', function() {
            $('#sEditCategoria').hide(0);
            $('#codC').html('');
            $('#sCadCategoria').show(200);
        });

        $('#listaCategorias button').on('click', function() {

            if ($(this).attr('id') === 'btnExcluir')
            {
                var idCategoria = $(this).parent().siblings("td:first").text();

                var postData = {id: idCategoria};

                $.loadPage('exccategoria', 'post', postData);
            }
            else if ($(this).attr('id') === 'btnEditar')
            {
                var sEdit = $('#sEditCategoria');
                var sCad = $('#sCadCategoria');

                $('#codC').html($(this).parent().siblings("td:first").text());
                $('#eCNome').val($(this).parent().siblings("td:nth-child(2)").text());

                if (sEdit.css('display') === 'none') {
                    sCad.hide(0);
                    sEdit.show(200);
                }

                $('#eCNome').blur().focus();
            }
        });

        $('#btnEditCategoria').on('click', function() {
            var idCategoria = $('#codC').html();

            var nomeCategoria = $('#eCNome').val();

            var postData = {id: idCategoria, novoNome: nomeCategoria};

            $.loadPage('editcategoria', 'post', postData);
        });

        var oTable = $('#listaCategorias').dataTable({
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