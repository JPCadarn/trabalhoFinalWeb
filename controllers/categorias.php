<?php

require_once(dirname(__FILE__).'/../models/categoria.php');

class CategoriasController{

	function edit($dados){
		$model = new CategoriaModel();
		if(!array_key_exists('id', $dados))
			return false;

		return $model->editar($dados);
	}
	
	function read($id = null){
		$model = new CategoriaModel();
		
		return $model->getDados($id);
	}

	function getCount(){
		$model = new CategoriaModel();

		return $model->getCount();
	}
	
	function create($dados){
		$model = new CategoriaModel();
		if(!array_key_exists('dados', $dados))
			return false;

		return $model->salvar($dados);
	}
	
	function delete($id){
		$model = new CategoriaModel();
		if(!$id)
			return false;

		echo json_encode($model->excluir($id));
	}

	function readProdutos($id){
		$model = new CategoriaModel();

		return $model->getProdutos($id);
	}

	function countProdutos($id){
		$model = new CategoriaModel();
		
		return $model->getCountProdutos($id);
	}
}
	if(isset($_POST) and !empty($_POST)){
		$classe = new CategoriasController();
		$metodo = $_POST['metodo'];
		unset($_POST['metodo']);
		$dados = $_POST;
		if($metodo == 'delete'){
			$retorno = $classe->$metodo($dados['id']);
			$retorno = json_encode($retorno);

			return $retorno;
		}elseif($classe->$metodo($dados)){
			header('Location: ..\views\categorias');
		}
	}

	if(!empty($_GET) AND isset($_GET['metodo'])){
		$classe = new CategoriasController();
		$metodo = $_GET['metodo'];
		unset($_GET['metodo']);
		$dados = $_GET;
		if($classe->$metodo($dados))
			header('Location: ..\categorias');
	}
?>