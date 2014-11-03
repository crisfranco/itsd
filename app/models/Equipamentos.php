<?php

class Equipamentos extends Eloquent
{
    protected $table = 'equipamentos';

    public function marca()
    {
        return $this->belongsTo( 'Marcas', 'id_marca' );
    }

    public function categoria()
    {
        return $this->belongsTo( 'Categorias', 'id_categoria' );
    }

    public function setor()
    {
        return $this->belongsTo( 'Setores', 'id_setor' );
    }
    
    public function usuario()
    {
        return $this->hasMany( 'Usuarios', 'id_equipamento' );
    }  

}
