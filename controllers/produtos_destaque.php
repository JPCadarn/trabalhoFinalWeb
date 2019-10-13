<?php

require_once('../models/produto_destaque.php');

class ProdutosDestaqueController{

	function edit($dados){
		$model = new ProdutoDestaqueModel();
		if(!array_key_exists('id', $dados))
			return false;

		return $model->editar($dados);
	}
	
	function read($id = null){
		$model = new ProdutoDestaqueModel();
		
		return $model->getDados($id);
	}
	
	function create($dados){
		$model = new ProdutoDestaqueModel();
		if(!array_key_exists('dados', $dados))
			return false;

		return $model->salvar($dados);
	}
	
	function delete($id){
		$model = new ProdutoDestaqueModel();
		if(!$id)
			return false;

		return $model->excluir($id);
	}
}
?>