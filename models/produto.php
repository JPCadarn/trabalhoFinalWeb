<?php

require_once(dirname(__FILE__).'/../controllers/conexao.php');

class ProdutoModel extends Conexao{
	function salvar($dados){
		if(array_key_exists('id', $dados))
			return $this->editar($dados);
		else
			return $this->criar($dados);
	}

	function excluir($id){
		$sql = 'DELETE FROM produtos WHERE id = '.$id;
		$excluido = $this->executarQuery($sql);

		return $excluido;
	}

	function getDados($id){
		$sql = 'SELECT * FROM produtos';

		if($id)
			$sql .= ' WHERE id = '.$id;

		return $this->executarQuery($sql);
	}

	function criar($dados){
		$sql = "
			INSERT INTO produtos
			(nome, descricao, valor, categoria_id, imagem, teor_alcoolico)
			VALUES 
			(
				'{$dados['dados']['nome']}', 
				'{$dados['dados']['descricao']}', 
				 {$dados['dados']['valor']}, 
				 {$dados['dados']['categoria_id']}, 
				'{$dados['dados']['imagem']}', 
				 {$dados['dados']['teor_alcoolico']}
			)
		";
		
		return $this->executarQuery($sql);
	}

	function editar($dados){
		$sql = "
			UPDATE produtos
			SET nome = '{$dados['dados']['nome']}', 
				descricao = '{$dados['dados']['descricao']}', 
				valor = {$dados['dados']['valor']}, 
				categoria_id = {$dados['dados']['categoria_id']}, 
				imagem = '{$dados['dados']['imagem']}', 
				teor_alcoolico = {$dados['dados']['teor_alcoolico']}
			WHERE id = {$dados['id']}
		";
		
		return $this->executarQuery($sql);
	}
}
