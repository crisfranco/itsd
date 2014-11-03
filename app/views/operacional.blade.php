<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ITSD - Nutrilite</title>

        <!-- Bootstrap -->
        {{ HTML::style('resources/css/bootstrap.min.css') }}

        <!-- font Awesome -->
        {{ HTML::style('resources/css/font-awesome.min.css') }}

        <!-- Ionicons -->
        {{ HTML::style('resources/css/ionicons.min.css') }}

        <!-- DataTable -->
        {{ HTML::style('resources/css/jquery.dataTables.min.css') }}
        {{ HTML::style('resources/css/jquery.dataTables_themeroller.min.css') }}

        <!-- AdminLTE -->
        {{ HTML::style('resources/css/AdminLTE.css') }}

        <!-- Geral -->
        {{ HTML::style('resources/css/geral.css') }}

        <!-- iCheck -->
        {{ HTML::style('resources/css/iCheck/all.css') }}

        <!-- Animate -->
        {{ HTML::style('resources/css/animate.css') }}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

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
        <!-- iCheck -->
        {{ HTML::script('resources/js/plugins/iCheck/icheck.min.js') }}

        <style>
            body {
                padding-top: 50px;
            }
            .starter-template {
                padding: 40px 15px;
                /*text-align: center;*/
            }
            #pageTab {
                margin: 10px;
            }

            .logo{
                border: solid 1px darkgoldenrod;
                background-color: rgba(0, 0, 0, 0.5);
                margin: 0 auto;
            }

            .logo td{
                margin: 0px;
                padding: 0px;
            }
            .logo span{
                margin-left: 7px;
                margin-right: 7px;
                color: #fff;
            }
        </style>
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <span class="navbar-brand">
                        ITSD
                    </span>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="#">Home</a>
                        </li>
                        <!--                        <li>
                                                    <a href="#about">Dados Cadastrais</a>
                                                </li>-->
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="navbar-text">
                            Olá {{ $nomeUsuario; }}
                        </li>
                        <li>
                            <a id="logout" href="#">Logout</a>
                        </li>
                        <li>
                            <a id="senha" href="#" data-toggle="modal" data-target=".bs-example-modal-sm">Senha</a>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
        <div class="container">
            <div class="starter-template">
                <div class="content">                    
                    @include('users.chamados')
                </div>
            </div>
        </div><!-- /.container -->

        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" style="width: 270px; margin: 0 auto;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Redefinir a Senha</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formRedefinirSenha">                            
                            <p><input type="password" id="senhaAtual" name="senhaAtual" id="senhaAtual" placeholder="senha atual" class="form-control input-lg floatlabel"></p>
                            <p><input type="password" id="novaSenha" name="novasenha" id="novaSenha" placeholder="nova senha" class="form-control input-lg floatlabel"></p>
                            <p><input type="password" id="novaSenha2" id="novaSenha2" placeholder="repita a senha" class="form-control input-lg floatlabel"></p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="btnAlterarSenha" class="btn btn-primary">Alterar</button>
                    </div>
                </div>
            </div>
        </div>


        {{ HTML::script('resources/js/floatlabels.js') }}

        <script type="text/javascript">
            $(document).on('ready ajaxStop', function () {
                $('.floatlabel').floatlabel({
                    labelEndTop: 0,
                    labelClass: 'label-floatlabel_ex'
                });
            });

            $('#logout').click(function (e) {
                e.preventDefault();
                $.goLoginOut('logout', 'get');
            });

            $('#btnAlterarSenha').click(function (e) {

                if ($('#senhaAtual').val().trim() === '' || $('#novaSenha').val().trim() === '' || $('#novaSenha2').val().trim() === '') {
                    alert('Senhas não podem ser vazias.');
                    return;
                }

                if ($('#novaSenha').val() !== $('#novaSenha2').val()) {
                    alert('Senhas não conferem');
                    return;
                }

                $.ajax({
                    type: 'post',
                    url: 'alterarsenha',
                    data: $('#formRedefinirSenha').serialize()
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

                        case 'LR':
                            $('.bs-example-modal-sm').modal('hide');
                            alert('Senha alterada com sucesso.');
                            break;

                        case 'SI':
                            alert('Senha inválida.');
                            break;
                    }

                }).fail(function (xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Ocorreu um erro com sua requisição. Por favor, contate a TI no ramal 9854.');
                });
            });

            $('.bs-example-modal-sm').on('hidden.bs.modal', function (e) {
                $('#senhaAtual').val('');
                $('#novaSenha').val('');
                $('#novaSenha2').val('');
                $('#senhaAtual').blur();
                $('#novaSenha').blur();
                $('#novaSenha2').blur();
            })
        </script>
    </body>

</html>