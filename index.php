<!doctype html>
<html lang="pt-br">
<head>
</head>
<body>
	<?php
		require_once('views/utils/sessao.php');
		require_once('controllers/usuarios.php');
		$usuariosController = new UsuariosController();
		$admin = [
			'dados' => [
				'email' => 'ADMIN',
				'senha' => 'MASTER',
				'nome' => 'ADMIN',
				'cpf' => 'ADMIN',
				'data_nascimento' => date('YYYY-mm-dd'), 
				'admin' => true
			],
		];		
		$usuariosController->create($admin);
		$sessao = new Sessao();
		$sessao->iniciarSessao();
		header('Location: views/site/');
	?>
</body>
</html>