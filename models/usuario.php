<?php

require_once('conexao.php');

class UsuarioModel extends Conexao{
	function salvar($dados){
		if(array_key_exists('id', $dados))
			return $this->editar($dados);
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

	function editar($dados){
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
}
