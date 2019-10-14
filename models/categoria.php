<?php

require_once(dirname(__FILE__).'/../controllers/conexao.php');

class CategoriaModel extends Conexao{
	function salvar($dados){
		if(array_key_exists('id', $dados))
			return $this->editar($dados);
		else
			return $this->criar($dados);
	}

	function excluir($id){
		$sql = 'DELETE FROM categorias WHERE id = '.$id;
		$excluido = $this->executarQuery($sql);

		return $excluido;
	}

	function getCountProdutos($id){
		$where = null;

		if($id)
			$where = ' WHERE categoria_id = '.$id;
	
		$sql = '
			SELECT COUNT(*) as count
			FROM produtos
			'.$where.'
			GROUP BY categoria_id';
		
		return $this->executarQuery($sql);
	}

	function getDados($id){
		$where = null;

		if($id)
			$where = ' WHERE id = '.$id;
	
		$sql = '
			SELECT * 
			FROM categorias
			'.$where;
		return $this->executarQuery($sql);
	}

	function criar($dados){
		$sql = "
			INSERT INTO categorias
			(nome) 
			VALUES 
			('{$dados['dados']['nome']}')
		";

		return $this->executarQuery($sql);
	}

	function editar($dados){
		$sql = "
			UPDATE categorias
			SET nome = '{$dados['dados']['nome']}'
			WHERE id = {$dados['id']};
		";

		return $this->executarQuery($sql);
	}
}
