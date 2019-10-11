<?php

require_once('../models/endereco.php');

class EnderecosController{

	function edit($dados){
		$model = new EnderecoModel();
		if(!array_key_exists('id', $dados))
			return false;

		return $model->editar($dados);
	}
	
	function read($id = null){
		$model = new EnderecoModel();
		
		return $model->getDados($id);
	}
	
	function create($dados){
		$model = new EnderecoModel();
		if(!array_key_exists('dados', $dados))
			return false;

		return $model->salvar($dados);
	}
	
	function delete($id){
		$model = new EnderecoModel();
		if(!$id)
			return false;

		return $model->excluir($id);
	}
}
?>