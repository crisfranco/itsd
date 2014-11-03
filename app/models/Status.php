<?php

class Status extends Eloquent
{
    protected $table = 'status';
    
    public function chamado()
    {
        return $this->hasMany( 'Chamados', 'id_status' );
    }
}
