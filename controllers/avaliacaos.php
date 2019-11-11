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

	function readProduto($produtoId){
		$model = new AvaliacaoModel();

		return $model->getAvaliacaosProduto($produtoId);
	}
	
	function create($dados){
		$model = new AvaliacaoModel();
		if(!array_key_exists('dados', $dados))
			return false;

		echo json_encode($model->salvar($dados));
	}
	
	function delete($id){
		$model = new AvaliacaoModel();
		if(!$id)
			return false;

		return $model->excluir($id);
	}
}
	if(isset($_POST) and !empty($_POST)){
		$classe = new AvaliacaosController();
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
		$classe = new AvaliacaosController();
		$metodo = $_GET['metodo'];
		unset($_GET['metodo']);
		$dados = $_GET;
		if($classe->$metodo($dados))
			header('Location: ..\produtos');
	}
?>