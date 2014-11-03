<?php

class HelpersCategorias extends Eloquent
{
    protected $table = 'helpers_categorias';
    
    public function helper()
    {
        return $this->belongsTo( 'Helpers', 'id_helper' );
    }
    
    public function chamado(){
        return $this->hasMany( 'Chamados', 'id_helper_categoria' );
    }
}
