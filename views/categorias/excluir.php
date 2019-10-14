<?php
	require_once('../../controllers/categorias.php');
	$controller = new CategoriasController();
	$controller->delete($_GET['id']);
?>