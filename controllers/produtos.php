<?php

require_once(dirname(__FILE__).'/../models/produto.php');

class ProdutosController{

	function edit($dados){
		$model = new ProdutoModel();
		if(!array_key_exists('id', $dados))
			return false;
		
		return $model->editar($dados);
	}
	
	function read($id = null){
		$model = new ProdutoModel();
		
		return $model->getDados($id);
	}
	
	function create($dados){
		$model = new ProdutoModel();
		if(!array_key_exists('dados', $dados))
			return false;

		return $model->salvar($dados);
	}
	
	function delete($id){
		$model = new ProdutoModel();
		if(!$id)
			return false;

		echo json_encode($model->excluir($id));
	}
}
	if(isset($_POST) and !empty($_POST)){
		$classe = new ProdutosController();
		$metodo = $_POST['metodo'];
		unset($_POST['metodo']);
		$dados = $_POST;
		if($metodo == 'delete'){
			$retorno = $classe->$metodo($dados['id']);
			$retorno = json_encode($retorno);

			return $retorno;
		}elseif($classe->$metodo($dados)){
			header('Location: ..\views\produtos');
		}
	}

	if(!empty($_GET) AND isset($_GET['metodo'])){
		$classe = new ProdutosController();
		$metodo = $_GET['metodo'];
		unset($_GET['metodo']);
		$dados = $_GET;
		if($classe->$metodo($dados))
			header('Location: ..\produtos');
	}
?>