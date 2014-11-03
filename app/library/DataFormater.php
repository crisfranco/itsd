<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormatarDatas
 *
 * @author Cris
 */

class DataFormater
{
    public static function formatar($dataOriginal){
        return date( 'Y-m-d', strtotime( str_replace( '/', '-', $dataOriginal ) ) );
    }
}
