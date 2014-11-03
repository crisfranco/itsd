<div class="row">
    <section class="col-md-5 connectedSortable ui-sortable">
        <div class="box box">
            <div class="box-header">
                <h3 class="box-title">Marcas</h3>
                <div class="box-tools pull-right">                    
                    <button class="btn btn-default btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <table id="listaMarcas" class="table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Cód.</th>
                            <th>Nome</th> 
                            <th>Ações</th> 
                        </tr>
                    </thead>            
                    <tbody>                
                        <?php foreach ( $todas_as_marcas as $e ) : ?>
                            <tr>
                                <td><?php echo $e->id; ?></td>
                                <td><?php echo $e->nome; ?></td>                             
                                <td><button id="btnExcluir" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Excluir"><i class="fa fa-eraser"></i></button> <button id="btnEditar" class="btn btn-github btn-xs" data-toggle="tooltip" title="Editar"><i class="fa fa-gears"></i></button></td>
                            </tr>
                        <?php endforeach; ?> 
                    </tbody>            
                </table>
            </div>
            <!--            <div class="box-footer">
                            Registros: <code>{{$todas_as_marcas->count();}}</code>
                        </div>-->
        </div>
    </section>
    <section id="sCadMarca" class="col-md-3 connectedSortable ui-sortable">        
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Cadastrar Marca</h3>
                <div class="box-tools pull-right">                    
                    <button class="btn btn-default btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form id="frmMarcas">
                    <input id="mNome" name="mNome" class="form-control input-lg floatlabel" type="text" placeholder="Marca">
                </form>
            </div>
            <div class="box-footer text-right">
                <button id="btnCadMarca" type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>        
    </section>
    <section id="sEditMarca" class="col-md-3 connectedSortable ui-sortable">        
        <div class="box box-warning">
            <div class="box-header">
                <h3 class="box-title">Editar Marca</h3>
                <div class="box-tools pull-right">                    
                    <button id="btnSEditHide" class="btn btn-default btn-xs"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form id="frmEditMarcas">
                    <p>Cód.: <code id="codM"></code></p>
                    <input id="eMNome" name="mNome" class="form-control input-lg floatlabel" type="text" placeholder="Marca">
                </form>
            </div>
            <div class="box-footer text-right">
                <button id="btnEditMarca" type="submit" class="btn btn-primary">Editar</button>
            </div>
        </div>        
    </section>
</div>

<script type="text/javascript">
    $( function() {
        $( '.content-header h1' ).html( 'Marcas <small>gerenciamento</small>' );

        $( '#sEditMarca' ).hide( 0 );

        $( '.lMarcas small' ).html( "<?php echo $todas_as_marcas->count(); ?>" );

        $( '#frmMarcas' ).submit( function( e ) {
            e.preventDefault();
        } );

        $( '#btnCadMarca' ).on( 'click', function( e ) {
            e.preventDefault();
            $.loadPage( 'cadmarca', 'post', $( '#frmMarcas' ).serialize() );
        } );

        $( '#mNome, #eMNome' ).keydown( function( e ) {
            if ( e.keyCode === 13 ) {
                e.preventDefault();
                if ( $( this ).attr( 'id' ) === 'mNome' ) {
                    $( '#btnCadMarca' ).trigger( 'click' );
                } else if ( $( this ).attr( 'id' ) === 'eMNome' ) {
                    $( '#btnEditMarca' ).trigger( 'click' );
                }
            }
        } );

        $( '#btnSEditHide' ).on( 'click', function() {
            $( '#sEditMarca' ).hide( 0 );
            $( '#codM' ).html( '' );
            $( '#sCadMarca' ).show( 200 );
        } );

        $( '#listaMarcas button' ).on( 'click', function() {

            if ( $( this ).attr( 'id' ) === 'btnExcluir' )
            {
                var idMarca = $( this ).parent().siblings( "td:first" ).text();
                var postData = { id: idMarca };
                $.loadPage( 'excmarca', 'post', postData );
            }
            else if ( $( this ).attr( 'id' ) === 'btnEditar' )
            {
                var sEdit = $( '#sEditMarca' );
                var sCad = $( '#sCadMarca' );
                $( '#codM' ).html( $( this ).parent().siblings( "td:first" ).text() );
                $( '#eMNome' ).val( $( this ).parent().siblings( "td:nth-child(2)" ).text() );
                if ( sEdit.css( 'display' ) === 'none' ) {
                    sCad.hide( 0 );
                    sEdit.show( 200 );
                }

                $( '#eMNome' ).blur().focus();
            }
        } );

        $( '#btnEditMarca' ).on( 'click', function() {
            var idMarca = $( '#codM' ).html();
            var nomeMarca = $( '#eMNome' ).val();
            var postData = { id: idMarca, novoNome: nomeMarca };
            $.loadPage( 'editmarca', 'post', postData );
        } );

        var oTable = $( '#listaMarcas' ).dataTable( {
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
            aoColumnDefs: [ //Desabilitando o sorting para a última coluna (Ações)
                {
                    bSortable: false,
                    aTargets: [ -1 ]
                }
            ]
        } );
    } );
</script>