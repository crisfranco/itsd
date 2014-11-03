<!doctype html>
<html lang="pt-br">
    <head>        
        <meta charset="UTF-8">
        <meta http-equiv="pragma" content="no-cache">
        <title>ITSD :: Login Administrativo</title>

        <SCRIPT LANGUAGE="JavaSCRIPT">
            var ua = window.navigator.userAgent;
            var msie = ua.indexOf("MSIE ");

            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
                window.location.replace('noie');
            }
        </SCRIPT>

        {{ HTML::style('resources/css/bootstrap.min.css') }}
        <!-- Geral -->
        {{ HTML::style('resources/css/geral.css') }}
        <!-- Animate -->
        {{ HTML::style('resources/css/animate.css') }}
        <style>
            body{
                background-color: #000;
                background-image: url('resources/img/background/<?php echo mt_rand(6, 6); ?>.png'); //mt_rand( 1, 8 )
                background-repeat:no-repeat;
                background-attachment:fixed;
                background-position:center;     
            }

            .invisivel{
                display: none;
            }

            .content {                  
                position: absolute;
                width: 350px;
                height: 106px;
                top: 50%;
                left: 50%;
                margin-left: -175px; /* Negative half of width. */
                margin-top: -53px; /* Negative half of height. */                
            }

            #frmLogin table{
                margin: 0 auto;
            }

            .login{
                margin-bottom: 20px;                
            }

            .logo{
                border: solid 1px rgba(96, 160, 46, 0.7);
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

            #username{
                width: 120px;
            }

            #password{
                width: 140px;
            }

            #frmLogin a{
                margin-left: 10px;
                color: #ddd;
                -webkit-transition: 0.5s;
                -moz-transition: 0.5s;
                -o-transition: 0.5s;
                -ms-transition: 0.5s;
                transition: 0.5s;
            }

            #frmLogin a:hover{                
                color: #fff;                
                text-decoration: none;
                text-shadow: 0 0 15px #FFFFFF;
                transform: scale(1.05);
            }            

            .floatlabel{
                background-color: transparent;
                color: white;
            }  

            #busy{
                position: absolute;
                top: 50%;
                left: 50%;
                -webkit-animation-duration: 1s;
                -moz-animation-duration: 1s;
            }

            #errMensagem{
                position: absolute;
                top: 50%;
                left: 50%;
                width: 400px;
                margin-left: -200px;
                color: orange;
                text-align: center;
                margin-top: 70px;
                text-shadow: 0 0 15px orange;
                transform: scale(1.05);                
                -webkit-animation-duration: 1s;
                -moz-animation-duration: 1s;
            }

            #content_mudar_senha{
                position: absolute;
                width: 177px;
                height: 180px;
                top: 50%;
                left: 50%;
                margin-left: -88.5px; /* Negative half of width. */
                margin-top: -90px; /* Negative half of height. */
                border: solid 1px rgba(255, 255, 255, 0.15);
            }

            #content_mudar_senha table{
                margin: 10px;
                text-align: center;
            }

            #content_mudar_senha a{
                color: #ddd;
                -webkit-transition: 0.5s;
                -moz-transition: 0.5s;
                -o-transition: 0.5s;
                -ms-transition: 0.5s;
                transition: 0.5s;
            }

            #content_mudar_senha a:hover{
                color: #fff;                
                text-decoration: none;
                text-shadow: 0 0 15px #FFFFFF;
                transform: scale(1.05);
            }   

            #itsdDesc {                
                text-align: center;
                color: white;
                opacity: .7;
            }

        </style>

    </head>
    <body>
        <div id="busy" class="invisivel"></div>
        <div id="errMensagem" class="invisivel">Usuário e/ou senha inválido(s).<br/>Se o problema persistir contate-nos no ramal 9854.</div>
        <div class="content invisivel">            
            <form id="frmLogin" autocomplete="off">
                <table>
                    <tr>
                        <td><input id="username" name="username" type="text" placeholder="AIU" class="kp form-control input-lg floatlabel login"></td>
                        <td><input id="password" name="password" type="password" placeholder="Senha" class="kp form-control input-lg  floatlabel login"></td>
                        <td><a href="#" id="btnLogin" class="kp efeito">Entrar</a></td>
                    </tr>
                </table>
                <table class="logo">
                    <tr>
                        <td><img src="{{ asset('resources/img/login/nutrilite_logo.jpg') }}"/></td>
                        <td><span>ITSD</span></td>
                    </tr>                    
                </table>
                <div id="itsdDesc">
                    Information Technology Service Desk
                </div>
            </form>            
        </div>
        <div id="content_mudar_senha" class="invisivel">
            <form id="frmMudarSenha">
                <table>
                    <tr>
                        <td><input id="novasenha" name="novasenha" type="password" placeholder="Nova Senha" class="form-control input-lg floatlabel login kp"></td>                        
                    </tr>
                    <tr>
                        <td><input id="novasenha2" name="novasenha2" type="password" placeholder="Repita" class="form-control input-lg floatlabel login kp"></td>                        
                    </tr>
                    <tr>                        
                        <td><a href="#" id="btnNovaSenha" class="efeito kp">Cadastrar a nova senha</a></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
    {{ HTML::script('resources/js/jquery-2.1.0.min.js') }}
    {{ HTML::script('resources/js/bootstrap.min.js') }}
    <!--{{ HTML::script('resources/js/bootstrap-switch.min.js') }}-->
    {{ HTML::script('resources/js/floatlabels.js') }}
    {{ HTML::script('resources/js/jquery.easing.1.3.js') }}
    {{ HTML::script('resources/js/geral.js') }}

    <!-- spin -->
    {{ HTML::script('resources/js/Spin.js') }}

    <script type="text/javascript">

        //Comentário em javascript       
        var opts = {
            lines: 24, // The number of lines to draw
            length: 3, // The length of each line
            width: 2, // The line thickness
            radius: 300, // The radius of the inner circle
            corners: 1, // Corner roundness (0..1)
            rotate: 0, // The rotation offset
            direction: 1, // 1: clockwise, -1: counterclockwise
            color: '#fff', // #rgb or #rrggbb or array of colors
            speed: 1, // Rounds per second
            trail: 60, // Afterglow percentage
            shadow: false, // Whether to render a shadow
            hwaccel: false, // Whether to use hardware acceleration
            className: 'spinner', // The CSS class to assign to the spinner
            zIndex: 2e9, // The z-index (defaults to 2000000000)
            top: '50%', // Top position relative to parent
            left: '50%' // Left position relative to parent
        };

        var target = document.getElementById('busy');
        new Spinner(opts).spin(target);

        $(window).load(function () {
            $('.content').removeClass('invisivel').addClass('animated bounceIn');
            $('#username').focus();
        });

        $(function () {

            if (window.history) {//Evitando usuário clicar no botão BACK do Browser
                window.history.forward(1);
            }

            $('.floatlabel').floatlabel({
                labelEndTop: 0,
                labelClass: 'label-floatlabel_ex'
            });
            $('#btnLogin').click(function (e) {
                e.preventDefault();
                $('.content').removeClass('animated bounceIn tada');
                $('#busy').removeClass('invisivel bounceOut').addClass('animated bounceIn');

                if ($('#errMensagem').hasClass('invisivel') === false) { //Se tiver visível
                    $('#errMensagem').removeClass().addClass('animated flipOutX').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                        $('#errMensagem').removeClass().addClass('invisivel');
                        fazerLoginLogout();
                    });
                } else {
                    fazerLoginLogout();
                }
            });

            function fazerLoginLogout() {
                $.goLoginOut('', 'post', $('#frmLogin').serialize(), function () {

                    $('#errMensagem').removeClass().addClass('animated flipInX').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                        console.log('entrou...');
                    });

                    $('#busy').removeClass('animated bounceIn').addClass('animated bounceOut');
                    $('.content').addClass('animated tada');
                });
            }

            $('#btnNovaSenha').click(function (e) {
                e.preventDefault();

                if ($('#novasenha').val() !== $('#novasenha2').val()) {
                    if ($('#errMensagem').hasClass('invisivel') === true) {
                        $('#errMensagem').text('As senhas não conferem.').removeClass().addClass('animated flipInX');
                    } else {
                        $('#errMensagem').removeClass().addClass('animated shake').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                            $('#errMensagem').removeClass();
                        });
                    }
                } else {
                    if ($('#errMensagem').hasClass('invisivel') === false) {
                        $('#errMensagem').removeClass().addClass('animated flipOutX').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                            $.goLoginOut('novasenha', 'post', $('#frmMudarSenha').serialize(), null, function () {
                                $('#errMensagem').html('Erro no acesso o sistema.<br/>Por favor, contate-nos no ramal 9854.').removeClass().addClass('animate flipInX');
                            });
                        });
                    } else {
                        $.goLoginOut('novasenha', 'post', $('#frmMudarSenha').serialize(), null, function () {
                            $('#errMensagem').html('Erro no acesso o sistema.<br/>Por favor, contate-nos no ramal 9854.').removeClass().addClass('animate flipInX');
                        });
                    }
                }
            });
        });
    </script>
</html>
