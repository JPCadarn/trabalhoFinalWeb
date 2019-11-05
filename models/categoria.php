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
		$countProdutos = $this->getCountProdutos($id)[0]['count'];
		$countProdutos = 0;
		if($countProdutos){
			$sql = 'DELETE FROM categorias WHERE id = '.$id;
			$excluido = $this->executarQuery($sql);

			return $excluido;
		}else{
			return 2;
		}
	}

	function getCount(){
		$sql = "
			SELECT COUNT(*) as count
			FROM categorias
		";

		return $this->executarQuery($sql);
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

	function getProdutos($id){
		if($id){
			$sql = "
				SELECT *
				FROM produtos
				WHERE categoria_id = $id
			";

			return $this->executarQuery($sql);
		}else
			return false;
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
