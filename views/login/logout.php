<?php
	require_once('../../controllers/usuarios.php');
	$controller = new UsuariosController();
	$controller->logout();
	header('Location: '.$_SERVER['HTTP_REFERER']);
?>