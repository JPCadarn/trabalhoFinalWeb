<?php

require_once(dirname(__FILE__).'/../controllers/conexao.php');

class EnderecoModel extends Conexao{
	function salvar($dados){
		if(array_key_exists('id', $dados))
			return $this->editar($dados);
		else
			return $this->criar($dados);
	}

	function excluir($id){
		$sql = 'DELETE FROM enderecos WHERE id = '.$id;
		$excluido = $this->executarQuery($sql);

		return $excluido;
	}

	function getEnderecos($usuarioId){
		$sql = 'SELECT * FROM enderecos WHERE usuario_id = '.$usuarioId;

		return $this->executarQuery($sql);
	}

	function getDados($id){
		$sql = 'SELECT * FROM enderecos';

		if($id)
			$sql .= ' WHERE id = '.$id;

		return $this->executarQuery($sql);
	}

	function criar($dados){
		$sql = "
			INSERT INTO enderecos
			(usuario_id, cep, rua, bairro, numero, complemento, cidade, estado, referencia)
			VALUES 
			(
				{$dados['dados']['usuario_id']}, 
				'{$dados['dados']['cep']}',
				'{$dados['dados']['rua']}',
				'{$dados['dados']['bairro']}',
				{$dados['dados']['numero']},
				'{$dados['dados']['complemento']}',
				'{$dados['dados']['cidade']}',
				'{$dados['dados']['estado']}',
				'{$dados['dados']['referencia']}'
			)
		";
		
		return $this->executarQuery($sql);
	}

	function editar($dados){
		$sql = "
			UPDATE enderecos
			SET cep = '{$dados['dados']['cep']}', 
				destinatario = '{$dados['dados']['destinatario']}',
				rua = '{$dados['dados']['rua']}',
				bairro = '{$dados['dados']['bairro']}',
				numero = {$dados['dados']['numero']},
				complemento = '{$dados['dados']['complemento']}',
				cidade = '{$dados['dados']['cidade']}',
				estado = '{$dados['dados']['estado']}',
				referencia = '{$dados['dados']['referencia']}'
			WHERE id = {$dados['id']}
		";
		
		return $this->executarQuery($sql);
	}
}
