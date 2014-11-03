<?php

class MailController extends BaseController {

    public static function notificarAberturaChamado() {        
        
        Mail::send('emails.aberturaChamadoA', array(), function($message) {
            $message->to(array(
                'cristiano.franco@amway.com' => 'Cristiano Franco',
                'rarison.mendes@amway.com' => 'Rarison Mendes',
                'pedro.lima@amway.com' => 'Pedro Lima'));
            $message->subject("Chamado aberto por " . Auth::user()->nome);
        });

        Mail::send('emails.aberturaChamadoU', array(), function($message) {
            $message->to(Auth::user()->email, Auth::user()->nome);
            $message->subject('Chamado aberto');
        });
    }

    public static function notificarReaberturaChamado() {

//        Mail::send('emails.aberturaChamadoA', array(), function($message) {
//            $message->to(array(
//                'cristiano.franco@amway.com' => 'Cristiano Franco',
//                'rarison.mendes@amway.com' => 'Rarison Mendes',
//                'pedro.lima@amway.com' => 'Pedro Lima'));
//            $message->subject(Auth::user()->nome);
//        });
//
//        Mail::send('emails.aberturaChamadoU', array(), function($message) {
//            $message->to(Auth::user()->email, Auth::user()->nome);
//            $message->subject('Chamado efetivado');
//        });
    }
    
    public static function notificarEncerramentoChamado($dados) {
                
        Mail::send('emails.encerramentoChamadoU', $dados, function($message) use($dados) {
            $message->to($dados['emailUsuario'], $dados['usuario']);
            $message->subject('Chamado encerrado');
        });        
    }
}