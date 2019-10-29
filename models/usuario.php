<?php

require_once(dirname(__FILE__).'/../controllers/conexao.php');

class UsuarioModel extends Conexao{
	function salvar($dados){
		if(array_key_exists('id', $dados))
			return $this->editar($dados);
		elseif(isset($dados['dados']['admin']))
			return $this->criarAdmin($dados);
		else
			return $this->criar($dados);
	}

	function excluir($id){
		$sql = 'DELETE FROM usuarios WHERE id = '.$id;
		$excluido = $this->executarQuery($sql);

		return $excluido;
	}

	function getDados($id){
		$sql = 'SELECT * FROM usuarios';

		if($id)
			$sql .= ' WHERE id = '.$id;

		return $this->executarQuery($sql);
	}

	function criar($dados){
		$dados['dados']['senha'] = password_hash($dados['dados']['senha'], PASSWORD_BCRYPT);
		
		$sql = "
			INSERT INTO usuarios
			(email, senha, nome, cpf, data_nascimento)
			VALUES 
			(
				'{$dados['dados']['email']}', 
				'{$dados['dados']['senha']}',
				'{$dados['dados']['nome']}',
				'{$dados['dados']['cpf']}',
				'{$dados['dados']['data_nascimento']}'
			)
		";
		
		return $this->executarQuery($sql);
	}

	function criarAdmin($dados){
		$dados['dados']['senha'] = password_hash($dados['dados']['senha'], PASSWORD_BCRYPT);
		
		$sql = "
			INSERT INTO usuarios
			(email, senha, nome, cpf, data_nascimento, admin)
			VALUES 
			(
				'{$dados['dados']['email']}', 
				'{$dados['dados']['senha']}',
				'{$dados['dados']['nome']}',
				'{$dados['dados']['cpf']}',
				'{$dados['dados']['data_nascimento']}',
				{$dados['dados']['admin']}
			)
		";
		
		return $this->executarQuery($sql);
	}

	function editar($dados){
		$dados['dados']['senha'] = password_hash($dados['dados']['senha'], PASSWORD_BCRYPT);

		$sql = "
			UPDATE usuarios
			SET senha = '{$dados['dados']['senha']}', 
				email = '{$dados['dados']['email']}',
				nome = '{$dados['dados']['nome']}',
				cpf = '{$dados['dados']['cpf']}',
				data_nascimento = '{$dados['dados']['data_nascimento']}'
			WHERE id = {$dados['id']}
		";
		
		return $this->executarQuery($sql);
	}

	function logAcesso($id){
		$hora = date('H:i:s');
		$data = date('Y-m-d');		
		$sql = "
			INSERT INTO usuarios_acessos
			(usuario_id, data, hora)
			VALUES
			($id, '$data', '$hora')
		";

		return $this->executarQuery($sql);
	}

	function validarSenha($dados){
		$sqlSenhaAtual = "
			SELECT senha
			FROM usuarios
			WHERE id = {$dados['id']}
		";
		$senhaAtual = $this->executarQuery($sqlSenhaAtual)[0]['senha'];

		if(password_verify($dados['senhaAntiga'], $senhaAtual))
			return true;
		else
			return false;
	}

	function login($dados){
		if(session_status() <> PHP_SESSION_ACTIVE)
			session_start();
			
		$dadosUsuarioBD = $this->executarQuery("SELECT id, senha FROM usuarios WHERE email = '{$dados['email']}'")[0];
		$passou = password_verify($dados['senha'], $dadosUsuarioBD['senha']);

		
		if($passou){
			$this->logAcesso($dadosUsuarioBD['id']);
			$_SESSION['usuario'] = $this->getDados($dadosUsuarioBD['id'])[0];
			return true;
		}else
			return false;
	}

	function logout(){
		return session_unset();
	}
}
