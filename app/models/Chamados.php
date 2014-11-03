<?php

class Chamados extends Eloquent
{
    protected $table = 'chamados';
    
    public function helperCategoria()
    {
        return $this->belongsTo( 'HelpersCategorias', 'id_helper_categoria' );
    }
    
    public function status()
    {
        return $this->belongsTo( 'Status', 'id_status' );
    }
    
    public function servico()
    {
        return $this->hasMany( 'Servicos', 'id_chamado' );
    }
    
    public function usuario()
    {
        return $this->belongsTo( 'Usuarios', 'id_usuario' );
    }
    
    public function usuarioAtendido()
    {
        return $this->belongsTo( 'Usuarios', 'id_usuario_atendido' );
    }
    
    public function chamadoCaso()
    {
        return $this->hasMany( 'ChamadosCasos', 'id_chamado' );
    }
}
