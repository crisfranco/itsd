$.goLoginOut = function(url, tipo, sdata, callBackError, callBackErrorSystem) {

    $.ajax({
        type: tipo,
        url: url,
        data: (typeof sdata !== 'undefined') ? sdata : ''
    }).done(function(data) {

        switch (data) {
            case 'UNA':
                console.log('UNA - Usuário Não Ativo');
                break;
            case 'SP':
                console.log('SP - Senha Padrão. Por favor, mudar a senha.');
                $('#frmLogin').removeClass('animated bounceIn').addClass('animated bounceOut').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
                    $('#content_mudar_senha').removeClass().addClass('animated bounceIn');
                    $('#novasenha').focus();
                    $('#errMensagem').css('margin-top', '95px');
                });
                break;
            case 'LR':
                console.log('LR - Login Realizado');
                $('#busy').removeClass('animated bounceIn').addClass('animated bounceOut');
                window.location.replace('');
                break;
            case 'UFL':
                console.log('UFL - Usuário Fez Logout');
                window.location.replace('');
                break;
            case 'USI':
                console.log('USI - Usuário e/ou senha inválido(s), se o problema persistir contate-nos no ramal 9854');
                if (typeof callBackError !== 'undefined') {
                    callBackError();
                }
                break;
        }

    }).fail(function(xhr, status, error) {
        console.log(xhr.responseText);
        if (typeof callBackErrorSystem !== 'undefined') {
            callBackErrorSystem();
        }
    });
};

$.loadPage = function(url, tipo, sdata, callBack) {
    $.ajax({
        type: tipo,
        url: url,
        data: (typeof sdata !== 'undefined') ? sdata : ''
    }).done(function(data) {

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
                $('.content').html(data);
        }

    }).fail(function(xhr, status, error) {
        alert('Ocorreu um erro com a sua requisição.\nPor favor entre em contato com a TI no ramal 9854.');
        console.log(xhr.responseText);
    }).always(function() {
        if (typeof callBack !== 'undefined') {
            callBack();
        }
    });
};

$(function() {
    $('body .kp').keydown(function(e) {
        if (e.which === 13) {
            var index = $('.kp').index(this) + 1;
            $('.kp').eq(index).focus();
        }
    });

    $(document).ajaxStart(function()
    {
        $('body').addClass('wait');

    }).ajaxComplete(function() {

        $('body').removeClass('wait');

    });

});