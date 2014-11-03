<?php

class ChamadosCasos extends Eloquent
{

    protected $table = 'chamados_casos';

    public function caso()
    {
        return $this->belongsTo( 'Casos', 'id_caso' );
    }

    public function chamado()
    {
        return $this->belongsTo( 'Chamados', 'id_chamado' );
    }

}
