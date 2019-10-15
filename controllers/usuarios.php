<?php

require_once(dirname(__FILE__).'/../models/usuario.php');

class UsuariosController{

	function edit($dados){
		$model = new UsuarioModel();
		if(!array_key_exists('id', $dados))
			return false;

		return $model->editar($dados);
	}
	
	function read($id = null){
		$model = new UsuarioModel();
		
		return $model->getDados($id);
	}
	
	function create($dados){
		$model = new UsuarioModel();
		if(!array_key_exists('dados', $dados))
			return false;

		return $model->salvar($dados);
	}
	
	function delete($id){
		$model = new UsuarioModel();
		if(!$id)
			return false;

		return $model->excluir($id);
	}
}
?>