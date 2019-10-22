<!DOCTYPE html>
<html lang="pt-br">
<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css"  media="screen,projection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="..\..\assets\css\main.css">
</head>
  
<?php
	require_once('../../controllers/produtos.php');
	require_once('../../controllers/log_produtos.php');
	require_once('../utils/ehtml.php');
	date_default_timezone_set("America/Sao_Paulo");
	$controllerProdutos = new ProdutosController();
	$controllerLogs = new LogProdutosController();
	$controllerLogs->create(['id' => $_GET['id'], 'metodo' => 'create']);
	$produto = $controllerProdutos->read($_GET['id'])[0];
	$ehtml = new Ehtml();
?>
<body>
	<?php
		echo "<header>";
			echo $ehtml->navBar('Produtos');
		echo "</header>";
		$linkCategoria = trim($_SERVER['HTTP_REFERER']);
		echo "
			<nav>
				<div class='nav-wrapper indigo darken-4 center'>
				<div class='col s12'>
					<a href='index.php' class='breadcrumb'>Página Inicial</a>
					<a href='$linkCategoria' class='breadcrumb'>Produtos</a>
					<span class='breadcrumb'>{$produto['nome']}</span>
				</div>
				</div>
			</nav>
		";

		echo "<div class='col s12 m12'>
				<div class='card horizontal hoverable'>
				<div class='card-image'>
					<img src='../../assets/images/".$produto['imagem']."'>
				</div>
				<div class='card-stacked'>
					<h2 class='header center'>{$produto['nome']}</h2>
					<div class='card-content'>
						<p>{$produto['descricao']}</p>
					</div>
					<div class='card-action center'>
					<a class='indigo darken-4 waves-effect waves-light btn'><i class='material-icons left'>shopping_cart</i>Comprar</a>
				</div>
				</div>
			</div>";
		echo "<main>";
		echo "<div class='row'>
				<div class='col s12 m6'>
					<i class='materialboxed' width='500' src='../../assets/images/".$produto['imagem']."'></i>
				</div>
			</div>";
		echo "</main>";

		echo $ehtml->footer();
	?>

  	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="..\..\assets\js\main.js" crossorigin="anonymous"></script>
  </body>
</html>