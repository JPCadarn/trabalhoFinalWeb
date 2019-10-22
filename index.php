<!doctype html>
<html lang="pt-br">
<head>
</head>
<body>
	<?php
		require_once('controllers/usuarios.php');
		$usuarioController = new UsuariosController();
		$dados['dados'] = [
			'email' => 'ADMIN', 
			'senha' => 'MASTER',
			'nome'  => 'Administrativo',
			'cpf'   => 'Administrativo',
			'data_nascimento' => date('Y-m-d'),
			'admin' => 1
		];
		ini_set('session.auto_start', 1);

		$usuarioController->create($dados);

		header('Location: views/site');
	?>
</body>
</html>