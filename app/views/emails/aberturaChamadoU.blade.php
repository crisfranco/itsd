<table width="100%">
    <tr>
        <td>
            <table style="font-family: Arial, Helvetica, sans-serif;" width="75%" align="center">
                <tr>
                    <td style="font-size: x-small; font-weight: bold; color: #666666">Mensagem do ITSD</td>
                </tr>
                <tr>
                    <td bgcolor="#F0F0F0" style="border: 1px solid #FF3300; padding: 10px;">
                        <h1 style="font-size: large;">
                            <?php
                            echo "Olá, ", Auth::user()->nome;
                            ?>
                        </h1>
                        <h3 style="color: #666666">Seu chamado foi registrado, aguarde atendimento.</h3>                        
                        <p>
                            <?php
                            echo "<b>Ocorrência:</b></br>", Input::get('info');
                            ?>
                        </p>
                        <span style="font-size: xx-small; color: #666666;"><?php echo date('d/m/Y - H:i:s'); ?></span>
                    </td>
                </tr>                
            </table>
        </td>
    </tr>
</table>
