<!DOCTYPE html>
<html lang="pt-br">

<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css" media="screen,projection" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="..\..\assets\css\main.css">
</head>

<?php
require_once('../../controllers/categorias.php');
require_once('../utils/ehtml.php');
$controllerCategorias = new CategoriasController();
$categoria = $controllerCategorias->read($_GET['id'])[0];
$produtos = $controllerCategorias->readProdutos($_GET['id']);
$ehtml = new Ehtml();
?>

<body>
	<header>
		<?php
		echo $ehtml->navBar('');
		?>
	</header>
	<main>
		<nav>
			<div class='nav-wrapper indigo darken-4 center'>
				<div class='col s12'>
					<a href='../site/' class='breadcrumb'>Página Inicial</a>
					<a href='#' class='breadcrumb'>Produtos</a>
					<a href='#' class='breadcrumb ativo'><?php echo $categoria['nome'] ?></a>
				</div>
			</div>
		</nav>
		<div class="row">
			<?php
			foreach ($produtos as $produto) {
				echo "
				<div class='col s12 m4'>
					<div class='card hoverable'>
						<div class='card-image'>
							<a href='produto.php?id={$produto['id']}'><img src='..\..\assets\images\\" . $produto['imagem'] . "'></a>
						</div>
						<div class='card-content center'>
							<span class='card-title black-text'>{$produto['nome']}</span>
							<p>R$ {$produto['valor']}</p>
						</div>
					</div>
				</div>
				";
			}
			?>
		</div>
	</main>
	<?php
	echo $ehtml->footer();
	?>

	<script src="..\..\assets\js\jquery-3.4.1.js"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="..\..\assets\js\main.js" crossorigin="anonymous"></script>
</body>

</html>