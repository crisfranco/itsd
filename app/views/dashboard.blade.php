<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ITSD. Information Technology Service Desk</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        {{ HTML::style('resources/css/bootstrap.min.css') }}

        <!-- font Awesome -->
        {{ HTML::style('resources/css/font-awesome.min.css') }}

        <!-- Ionicons -->
        {{ HTML::style('resources/css/ionicons.min.css') }}

        <!-- AdminLTE -->
        {{ HTML::style('resources/css/AdminLTE.css') }}

        <!-- DataTable -->
        {{ HTML::style('resources/css/jquery.dataTables.min.css') }}
        {{ HTML::style('resources/css/jquery.dataTables_themeroller.min.css') }}

        <!-- Geral -->
        {{ HTML::style('resources/css/geral.css') }}

        <!--Datepicker-->
        {{ HTML::style('resources/css/datepicker3.css') }}

        <!-- iCheck -->
        {{ HTML::style('resources/css/iCheck/all.css') }}
        
        <!-- jQuery 2.1.0 -->
        {{ HTML::script('resources/js/jquery-2.1.0.min.js') }}
        <!-- Bootstrap -->
        {{ HTML::script('resources/js/bootstrap.min.js') }}
        <!-- DataTable -->
        {{ HTML::script('resources/js/jquery.dataTables.min.js') }}

        <!-- AdminLTE App -->
        {{ HTML::script('resources/js/AdminLTE.js') }}
        <!-- Geral -->
        {{ HTML::script('resources/js/geral.js') }}

        {{ HTML::script('resources/js/floatlabels.js') }}
        {{ HTML::script('resources/js/jquery.easing.1.3.js') }}
        {{ HTML::script('resources/js/bootstrap-datepicker.js') }}
        <!-- iCheck -->
        {{ HTML::script('resources/js/plugins/iCheck/icheck.min.js') }}

    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="#" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                ITSD - Nutrilite
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">                       
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $usuario; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="{{ asset('resources/img/avatar3.png') }}" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $usuario; ?> - Administrador
                                        <small>Tecnologia da Informação</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
<!--                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>-->
                                <!-- Menu Footer-->
                                <li class="user-footer">
<!--                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>-->
                                    <div class="pull-right">
                                        <a id="logout" href="#" class="btn btn-default btn-flat">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ asset('resources/img/avatar3.png') }}" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $usuario; ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>                   
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a id="lDashboard" href="#">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>                        
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-tag"></i>
                                <span>Chamados</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="gchamadosabertos" class="lChamados"><i class="fa fa-folder-open-o"></i> Abertos<small class="badge pull-right bg-red">{{ $chamados_fechados->count(); }}</small></a></li>
                                <li><a href="gchamadosfechados" class="lChamadosFechados"><i class="fa fa-folder-o"></i> Fechados<small class="badge pull-right bg-red">{{ $chamados_fechados->count(); }}</small></a></li>                                
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Usuários</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">                                
                                <li><a href="gusuarios" class="lUsuarios"><i class="fa fa-indent"></i> Usuários<small class="badge pull-right bg-green">{{ $qtdUsuarios; }}</small></a></li>                                
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Equipamentos</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">                                                                
                                <li><a href="gequipamentos" class="lEquipamentos"><i class="fa fa-indent"></i> Equipamentos<small class="badge pull-right bg-green">{{ $qtdEquipamentos; }}</small></a></li>
                                <li><a href="gcategorias" class="lCategorias"><i class="fa fa-th-large"></i> Categorias<small class="badge pull-right bg-red">{{ $qtdCategorias; }}</small></a></li>
                                <li><a href="gmarcas" class="lMarcas"><i class="fa fa-list-ul"></i> Marcas<small class="badge pull-right bg-orange">{{ $qtdMarcas; }}</small></a></li>                                
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Blank page
                        <small>Control panel</small>
                    </h1>                   
                </section>

                <!-- Main content -->
                <section class="content">
                    @include('admins.a_chamados')
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
    <script type="text/javascript">

        function atualizarListaDeChamados() {

            if ($('.content-header h1').html() === 'Chamados <small>gerenciamento</small>') {
                if ($('#modalChamado').attr('class') === 'modal fade') {
                    $('.lChamados').click();
                    console.log('Nova ocorrência: ' + new Date());
                }
            }

            setTimeout(atualizarListaDeChamados, 30000);
        }
        
        atualizarListaDeChamados();

        $(document).on('ready ajaxStop', function() {
            $('.floatlabel').floatlabel({
                labelEndTop: 0,
                labelClass: 'label-floatlabel_ex'
            });            
        });

        $('#lDashboard').click(function() {
            window.location.replace('');
        });

        $('#logout').click(function(e) {
            e.preventDefault();

            $.goLoginOut('logout', 'get');
        });

        $('.lChamados, .lChamadosFechados, .lUsuarios, .lMarcas, .lCategorias, .lEquipamentos').click(function(e) {
            e.preventDefault();

            $.loadPage($(this).attr('href'), 'get');
        });

    </script>
</html>