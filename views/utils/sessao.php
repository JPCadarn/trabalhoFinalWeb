<?php
    require_once(dirname(__FILE__).'/../../controllers/usuarios.php');
    class Sessao{
        function criarAdmin(){

            $usuarioController = new UsuariosController();
            $dados['dados'] = [
                'email' => 'ADMIN', 
                'senha' => 'MASTER',
                'nome'  => 'Administrativo',
                'cpf'   => 'Administrativo',
                'data_nascimento' => date('Y-m-d'),
                'admin' => 1
            ];

            $usuarioController->create($dados);
        }

        function iniciarSessao(){
            ini_set('session.auto_start', 1);
            if(session_status() <> PHP_SESSION_ACTIVE)
                session_start();
            $this->criarAdmin();
        }
        
    }
?>