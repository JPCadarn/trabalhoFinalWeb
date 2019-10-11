<?php

require_once('conexao.php');

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

	function getDados($id){
		$sql = 'SELECT * FROM categorias ';

		if($id)
			$sql .= 'WHERE id = '.$id;

		return $this->executarQuery($sql);
	}

	function criar($dados){
		$sql = '
			INSERT INTO categorias
			(nome) 
			VALUES 
			('.$dados['dados']['nome'].')	
		';

		return $this->executarQuery($sql);
	}

	function editar($dados){
		$sql = '
			UPDATE categorias
			SET nome = \''.$dados['dados']['nome'].'\'
			WHERE id = '.$dados['id'];
		
		return $this->executarQuery($sql);
	}
}
