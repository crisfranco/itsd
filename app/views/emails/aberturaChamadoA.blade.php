<table width="100%">
    <tr>
        <td>
            <table style="font-family: Arial, Helvetica, sans-serif;" width="75%" align="center">
                <tr>
                    <td style="font-size: x-small; font-weight: bold; color: #666666">Mensagem do ITSD</td>
                </tr>
                <tr>
                    <td bgcolor="#F0F0F0" style="border: 1px solid #C0C0C0; padding: 10px;">
                        <h1 style="font-size: large;">
                            <?php
                            echo Auth::user()->nome, " - ", Auth::user()->equipamento->cn;
                            ?>
                        </h1>
                        <p>
                            <?php
                            echo Input::get('info');
                            ?>
                        </p>
                        <span style="font-size: xx-small; color: #666666;"><?php echo date('d/m/Y - H:i:s'); ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right; font-size: small" height="25px">
                        <a href="Http://10.218.230.10/itsd" target="_blank" style="color: #FF3300; text-decoration:none; font-size: x-small;">Acessar o ITSD</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
