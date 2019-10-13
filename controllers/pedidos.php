<?php

require_once('../models/pedido.php');

class PedidosController{

	function edit($dados){
		$model = new PedidoModel();
		if(!array_key_exists('id', $dados))
			return false;

		return $model->editar($dados);
	}
	
	function read($id = null){
		$model = new PedidoModel();
	
		return $model->getDados($id);
	}
	
	function create($dados){
		$model = new PedidoModel();
		if(!array_key_exists('dados', $dados))
			return false;

		return $model->salvar($dados);
	}
	
	function delete($id){
		$model = new PedidoModel();
		if(!$id)
			return false;

		return $model->excluir($id);
	}
}
?>