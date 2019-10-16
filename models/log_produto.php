<?php

require_once(dirname(__FILE__).'/../controllers/conexao.php');

class LogProdutoModel extends Conexao{
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

	function getDados($produto_id){
		$where = null;

		if($produto_id)
			$where = ' WHERE produto_id = '.$produto_id;
	
		$sql = '
			SELECT * 
			FROM produtos_acessos
			'.$where;
		return $this->executarQuery($sql);
	}

	function criar($id){
		$hora = date('H:i:s');
		$data = date('Y-m-d');
		$sql = "
			INSERT INTO produtos_acessos
			(produto_id, data, hora) 
			VALUES 
			($id, '$data', '$hora')
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
