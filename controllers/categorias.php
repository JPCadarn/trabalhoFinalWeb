<?php

require_once('../models/categoria.php');

class CategoriasController{

	function edit($dados){
		$model = new CategoriaModel();
		if(!array_key_exists('id', $dados))
			return false;

		return $model->editar($dados);
	}
	
	function read($id = null){
		$model = new CategoriaModel();
		
		return $model->getDados($id);
	}
	
	function create($dados){
		$model = new CategoriaModel();
		if(!array_key_exists('dados', $dados))
			return false;

		return $model->salvar($dados);
	}
	
	function delete($id){
		$model = new CategoriaModel();
		if(!$id)
			return false;

		return $model->excluir($id);
	}
}
?>