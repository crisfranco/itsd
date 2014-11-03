<?php

class Marcas extends Eloquent
{
    protected $table = 'marcas';
    
    public function equipamento()
    {
        return $this->hasMany( 'Equipamentos', 'id_marca' );
    }
}
