<?php

require_once(dirname(__FILE__).'/../controllers/conexao.php');

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

	function getCount(){
		$sql = "
			SELECT COUNT(*) AS count
			FROM produtos_destaque
		";

		return $this->executarQuery($sql);
	}

	function getDados($id){
		$sql = 'SELECT pd.*, p.imagem, p.nome, p.valor
				FROM produtos_destaque pd
				JOIN produtos p ON pd.produto_id = p.id';

		if($id)
			$sql .= ' WHERE pd.id = '.$id;

		$sql .= ' ORDER BY ordem ASC';

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
