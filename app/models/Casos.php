<?php

class Casos extends Eloquent
{

    protected $table = 'casos';

    public function chamadoCaso()
    {
        return $this->hasMany( 'ChamadosCasos', 'id_caso' );
    }        

}
