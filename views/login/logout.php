<?php
	require_once('../../controllers/usuarios.php');
	$controller = new UsuariosController();
	$controller->logout();
	header('Location: ../site/');
?>