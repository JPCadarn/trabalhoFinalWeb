<?php

require_once(dirname(__FILE__).'/../models/cartao.php');

class CartaosController{

	function edit($dados){
		$model = new CartaoModel();
		if(!array_key_exists('id', $dados))
			return false;

		return $model->editar($dados);
	}
	
	function read($id = null){
		$model = new CartaoModel();
		
		return $model->getDados($id);
	}
	
	function create($dados){
		$model = new CartaoModel();
		if(!array_key_exists('dados', $dados))
			return false;

		return $model->salvar($dados);
	}
	
	function delete($id){
		$model = new CartaoModel();
		if(!$id)
			return false;

		return $model->excluir($id);
	}
}
?>