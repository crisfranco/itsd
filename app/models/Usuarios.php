<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuarios extends Eloquent implements UserInterface, RemindableInterface
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array( 'password' );

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier( )
    {
        return $this -> getKey( );
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword( )
    {
        return $this -> password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken( )
    {
        return $this -> remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken( $value )
    {
        $this -> remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName( )
    {
        return 'remember_token';
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail( )
    {
        return $this -> email;
    }

    public function setor( )
    {
        return $this -> belongsTo( 'Setores', 'id_setor' );
    }

    public function equipamento( )
    {
        return $this -> belongsTo( 'Equipamentos', 'id_equipamento' );
    }
    
    public function chamado( )
    {
        return $this -> hasMany( 'Chamados', 'id_usuario' );
    }
    
    public function chamadoUsuarioAtendido( )
    {
        return $this -> hasMany( 'Chamados', 'id_usuario_atendido' );
    }

}
