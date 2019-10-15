<?php
	require_once('../../controllers/produtos.php');
	$controller = new ProdutosController();
	$controller->delete($_GET['id']);
?>