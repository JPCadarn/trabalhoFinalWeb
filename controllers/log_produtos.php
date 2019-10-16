<?php

require_once(dirname(__FILE__).'/../models/log_produto.php');

class LogProdutosController{
	
	function read($id = null){
		$model = new LogProdutoModel();
		
		return $model->getDados($id);
	}
	
	function create($dados){
		$model = new LogProdutoModel();
		
		if(!array_key_exists('id', $dados))
			return false;


		return $model->criar($dados['id']);
	}
	
	function delete($id){
		$model = new LogProdutoModel();
		if(!$id)
			return false;

		return $model->excluir($id);
	}
}
	if(isset($_POST) and !empty($_POST)){
		$classe = new LogProdutosController();
		$metodo = $_POST['metodo'];
		unset($_POST['metodo']);
		$dados = $_POST;
		$classe->$metodo($dados);
	}

	if(!empty($_GET) AND isset($_GET['metodo'])){
		$classe = new LogProdutosController();
		$metodo = $_GET['metodo'];
		unset($_GET['metodo']);
		$dados = $_GET;
		$classe->$metodo($dados);
	}
?>