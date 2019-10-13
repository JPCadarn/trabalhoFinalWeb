<?php

require_once('conexao.php');

class ProdutoDestaqueModel extends Conexao{
	function salvar($dados){
		if(array_key_exists('id', $dados))
			return $this->editar($dados);
		else
			return $this->criar($dados);
	}

	function excluir($id){
		$sql = 'DELETE FROM produtos_destaque WHERE id = '.$id;
		$excluido = $this->executarQuery($sql);

		return $excluido;
	}

	function getDados($id){
		$sql = 'SELECT * FROM produtos_destaque';

		if($id)
			$sql .= ' WHERE id = '.$id;

		return $this->executarQuery($sql);
	}

	function criar($dados){
		$sql = "
			INSERT INTO produtos_destaque
			(produto_id, ordem)
			VALUES 
			(
				{$dados['dados']['produto_id']}, 
				{$dados['dados']['ordem']}
			)
		";
		
		return $this->executarQuery($sql);
	}

	function editar($dados){
		$sql = "
			UPDATE produtos_destaque
			SET ordem = {$dados['dados']['ordem']}, 
				produto_id = {$dados['dados']['produto_id']}
			WHERE id = {$dados['id']}
		";
		
		return $this->executarQuery($sql);
	}
}
