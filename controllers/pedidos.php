<?php

require_once(dirname(__FILE__).'/../models/pedido.php');

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
		if(!array_key_exists('cabecalho', $dados) OR !array_key_exists('itens', $dados))
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
	if(isset($_POST) and !empty($_POST)){
		$classe = new PedidosController();
		$metodo = $_POST['metodo'];
		unset($_POST['metodo']);
		$dados = $_POST;
		if($classe->$metodo($dados))
			header('Location: ../views/site/index.php');
	}

	if(!empty($_GET) AND isset($_GET['metodo'])){
		$classe = new PedidosController();
		$metodo = $_GET['metodo'];
		unset($_GET['metodo']);
		$dados = $_GET;
		if($classe->$metodo($dados))
			header('Location: ../views/site/index.php');
	}
?>