<?php

class Servicos extends Eloquent
{

    protected $table = 'servicos';

    public function chamado()
    {
        return $this->belongsTo( 'Chamados', 'id_chamado' );
    }    

    public function procedimento()
    {
        return $this->belongsTo( 'Procedimentos', 'id_procedimento' );
    }    

}
