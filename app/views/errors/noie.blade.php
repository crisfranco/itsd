<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Não use Internet Explorer!</title>
        {{ HTML::style('resources/css/bootstrap.min.css') }}

        <style>
            #divTabela{
                position: absolute;
                top: 50%;
                left: 50%;
                margin-left: -275px;
                margin-top: -128px;
                width: 550px;
                height: 256px;
            }
        </style>
    </head>
    <body>
        <div id="divTabela">
            <table>
                <tr>
                    <td><img src="{{ asset('resources/img/ie_destroy.png') }}"/></td>
                    <td>
                        <h1>Não use o Internet Explorer!</h1>
                        <p>
                            O IE não oferece suporte a todos s recursos do ITSD.
                        </p>
                        <p>
                            Prefira o <a href="https://www.google.com/intl/en/chrome/browser/">Google Chrome</a>.
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
