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

	function login($dados){
		$model = new UsuarioModel();

		return $model->login($dados);
	}

	function logout(){
		$model = new UsuarioModel();

		return $model->logout();
	}

	function validaSenha($dados){
		$model = new UsuarioModel();

		echo json_encode($model->validarSenha($dados));
	}
}
	if(isset($_POST) and !empty($_POST)){
		$classe = new UsuariosController();
		$metodo = $_POST['metodo'];
		unset($_POST['metodo']);
		$dados = $_POST;
		if($metodo == 'validaSenha'){
			$retorno = $classe->$metodo($dados);
			$retorno = json_encode($retorno);

			return $retorno;
		}elseif($classe->$metodo($dados)){
			header('Location: '.$dados['link_retorno']);
		}
	}

	if(!empty($_GET) AND isset($_GET['metodo'])){
		$classe = new UsuariosController();
		$metodo = $_GET['metodo'];
		unset($_GET['metodo']);
		$dados = $_GET;
		if($classe->$metodo($dados))
			header('Location: '.$dados['link_retorno']);
	}
?>