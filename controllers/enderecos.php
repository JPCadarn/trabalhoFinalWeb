<?php

require_once(dirname(__FILE__).'/../models/endereco.php');

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

	function readEnderecos($usuarioId){
		$model = new EnderecoModel();
		
		return $model->getEnderecos($usuarioId);
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