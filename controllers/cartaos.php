<?php

require_once(dirname(__FILE__).'/../models/cartao.php');

class CartaosController{

	function edit($dados){
		$model = new CartaoModel();
		if(!array_key_exists('id', $dados))
			return false;

		return $model->editar($dados);
	}

	function readCartaos($usuarioId){
		$model = new CartaoModel();
		
		return $model->getCartaos($usuarioId);
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

		echo json_encode($model->excluir($id));
	}
}
	if(isset($_POST) and !empty($_POST)){
		$classe = new CartaosController();
		$metodo = $_POST['metodo'];
		unset($_POST['metodo']);
		$dados = $_POST;
		if($metodo == 'delete'){
			$retorno = $classe->$metodo($dados['id']);
			$retorno = json_encode($retorno);

			return $retorno;
		}elseif($classe->$metodo($dados)){
			header('Location: ../views/cartaos/');
		}
	}

	if(!empty($_GET) AND isset($_GET['metodo'])){
		$classe = new CartaosController();
		$metodo = $_GET['metodo'];
		unset($_GET['metodo']);
		$dados = $_GET;
		if($classe->$metodo($dados))
			header('Location: ../views/cartaos/');
	}
?>