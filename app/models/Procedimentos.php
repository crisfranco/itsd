<?php

class Procedimentos extends Eloquent
{
    protected $table = 'procedimentos';
    
    public function servico()
    {
        return $this->hasMany( 'Servicos', 'id_procedimento' );
    }
        
}
