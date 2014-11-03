<?php

class Categorias extends Eloquent
{
    protected $table = 'categorias';
    
    public function equipamento()
    {
        return $this->hasMany( 'Equipamentos', 'id_categoria' );
    }
}
