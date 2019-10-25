<?php

require_once(dirname(__FILE__).'/../controllers/conexao.php');

class CarrinhoModel extends Conexao{
	function salvar($dados){
		if(array_key_exists('id', $dados)){
			print_r($dados);exit;
			return $this->editar($dados);
		}
		else
			return $this->criar($dados);
	}

	function excluir($id){
		$sql = 'DELETE FROM carrinhos WHERE id = '.$id['id'];
		
		return $this->executarQuery($sql);
	}

	function getDados($userId){
		$sql = "
			SELECT c.*, p.nome, p.valor, p.imagem 
			FROM carrinhos c 
			JOIN produtos p ON c.produto_id = p.id 
			WHERE usuario_id = $userId
		";

		return $this->executarQuery($sql);
	}

	function criar($dados){
		$sql = "
			INSERT INTO carrinhos
			(usuario_id, produto_id)
			VALUES 
			(
				{$dados['dados']['usuario_id']}, 
				{$dados['dados']['produto_id']}
			)
		";
		
		return $this->executarQuery($sql);
	}

	function editar($dados){
		$sql = "
			UPDATE carrinhos
			SET usuario_id = {$dados['dados']['usuario_id']}, 
				produto_id = {$dados['dados']['produto_id']}, 
				quantidade = {$dados['dados']['quantidade']}
			WHERE id = {$dados['dados']['id']}
		";
		
		return $this->executarQuery($sql);
	}
}
