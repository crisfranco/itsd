<?php

class Setores extends Eloquent
{

    protected $table = 'setores';

    public function usuario()
    {
        return $this->hasMany( 'Usuarios', 'id_setor' );
    }

    public function equipamento()
    {
        return $this->hasMany( 'Equipamentos', 'id_setor' );
    }

}
