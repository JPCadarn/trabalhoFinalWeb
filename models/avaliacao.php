<?php

require_once(dirname(__FILE__).'/../controllers/conexao.php');

class AvaliacaoModel extends Conexao{
	function salvar($dados){
		if(array_key_exists('id', $dados))
			return $this->editar($dados);
		else
			return $this->criar($dados);
	}

	function getAvaliacaosProduto($produtoId){
		$sql = "SELECT * FROM avaliacaos WHERE produto_id = $produtoId";

		return $this->executarQuery($sql);
	}

	function excluir($id){
		$sql = 'DELETE FROM avaliacaos WHERE id = '.$id;
		$excluido = $this->executarQuery($sql);

		return $excluido;
	}

	function getDados($id){
		$sql = 'SELECT * FROM avaliacaos';

		if($id)
			$sql .= ' WHERE id = '.$id;

		return $this->executarQuery($sql);
	}

	function criar($dados){
		$sql = "
			INSERT INTO avaliacaos
			(usuario_id, produto_id, texto, nota)
			VALUES 
			(
				{$dados['dados']['usuario_id']}, 
				{$dados['dados']['produto_id']},
				'{$dados['dados']['texto']}',
				{$dados['dados']['nota']}
			)
		";
		
		return $this->executarQuery($sql);
	}

	function editar($dados){
		$sql = "
			UPDATE avaliacaos
			SET produto_id = '{$dados['dados']['produto_id']}', 
				usuario_id = {$dados['dados']['usuario_id']},
				texto = '{$dados['dados']['texto']}'
			WHERE id = {$dados['id']}
		";
		
		return $this->executarQuery($sql);
	}
}
