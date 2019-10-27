<?php

require_once(dirname(__FILE__).'/../models/carrinho.php');
header('Access-Control-Allow-Origin: *');

class CarrinhosController{

	function edit($dados){
		$model = new CarrinhoModel();
		if(!array_key_exists('id', $dados['dados']))
			return false;
				
		echo json_encode($model->editar($dados));
	}
	
	function read($userId){
		$model = new CarrinhoModel();
		
		return $model->getDados($userId);
	}
	
	function create($dados){
		$model = new CarrinhoModel();
		
		if(!array_key_exists('dados', $dados))
			return false;

		return $model->salvar($dados);
	}
	
	function delete($id){
		$model = new CarrinhoModel();
		if(!$id)
			return false;

		echo json_encode($model->excluir($id));
	}
}
	if(session_status() <> PHP_SESSION_ACTIVE)
		session_start();
		
	if(isset($_SESSION['usuario'])){
		if(isset($_POST) and !empty($_POST)){
			$classe = new CarrinhosController();
			$metodo = $_POST['metodo'];
			unset($_POST['metodo']);
			$dados = $_POST;
			if($metodo == 'edit' OR $metodo == 'delete'){
				$retorno = $classe->$metodo($dados);
				$retorno = json_encode($retorno);

				return $retorno;
			}elseif($classe->$metodo($dados)){
				header('Location: ..\views\site\carrinho.php');
			}
		}
		
		if(!empty($_GET) AND isset($_GET['metodo'])){
			$classe = new CarrinhosController();
			$metodo = $_GET['metodo'];
			unset($_GET['metodo']);
			$dados = $_GET;
			if($classe->$metodo($dados)){}
				header('Location: ..\views\site\carrinho.php');
		}
	}else
		header('Location: ..\views\login\index.php');
?>