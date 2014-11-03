<?php

class Helpers extends Eloquent
{
    protected $table = 'helpers';
    
    public function helperCategoria()
    {
        return $this->hasMany( 'HelpersCategorias', 'id_helper' );
    }
}
