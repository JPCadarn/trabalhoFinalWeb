<?php

require_once('../models/produto.php');

class ProdutosController{

	function edit($dados){
		$model = new ProdutoModel();
		if(!array_key_exists('id', $dados))
			return false;

		return $model->editar($dados);
	}
	
	function read($id = null){
		$model = new ProdutoModel();
		
		return $model->getDados($id);
	}
	
	function create($dados){
		$model = new ProdutoModel();
		if(!array_key_exists('dados', $dados))
			return false;

		return $model->salvar($dados);
	}
	
	function delete($id){
		$model = new ProdutoModel();
		if(!$id)
			return false;

		return $model->excluir($id);
	}
}
?>