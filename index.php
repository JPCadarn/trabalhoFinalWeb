<!doctype html>
<html lang="pt-br">
<head>
</head>
<body>
	<?php
		require_once('views/utils/sessao.php');
		$sessao = new Sessao();
		$sessao->iniciarSessao();
		header('Location: views/site/');
	?>
</body>
</html>