<?php

require_once(dirname(__FILE__).'/../models/avaliacao.php');

class AvaliacaosController{

	function edit($dados){
		$model = new AvaliacaoModel();
		if(!array_key_exists('id', $dados))
			return false;

		return $model->editar($dados);
	}
	
	function read($id = null){
		$model = new AvaliacaoModel();
	
		return $model->getDados($id);
	}
	
	function create($dados){
		$model = new AvaliacaoModel();
		if(!array_key_exists('dados', $dados))
			return false;

		return $model->salvar($dados);
	}
	
	function delete($id){
		$model = new AvaliacaoModel();
		if(!$id)
			return false;

		return $model->excluir($id);
	}
}
?>