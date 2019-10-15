<?php
	require_once('../../controllers/produtos_destaque.php');
	$controller = new ProdutosDestaqueController();
	$controller->delete($_GET['id']);
?>