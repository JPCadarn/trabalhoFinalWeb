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
if (session_status() <> PHP_SESSION_ACTIVE)
	session_start();

if (!$_SESSION['usuario']['admin'])
	header('Location: ../site/');

require_once('../../controllers/produtos.php');
require_once('../utils/ehtml.php');
$controller = new ProdutosController();
$produtos = $controller->read();
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
					<a href='../administrativo/' class='breadcrumb'>Painel Administrativo</a>
					<a href='#' class='breadcrumb ativo'>Produtos</a>
					<a href='add.php' class="modal-trigger btn-floating halfway-fab waves-effect waves-light indigo"><span class="btn-breadcrumb">&#43;</span></a>
				</div>
			</div>
		</nav>
		<div class="row">
			<?php
			foreach ($produtos as $produto) {
				echo "
					<div id='produto".$produto['id']."' class='col s12 m4'>
						<div class='card hoverable'>
							<div class='card-image'>
								<img src='..\..\assets\images\\" . $produto['imagem'] . "'>
							</div>
							<div class='card-content center'>
								<span class='card-title black-text'>{$produto['nome']}</span>
								<p>{$produto['nome_categoria']}</p>
								<p>R$ {$produto['valor']}</p>
							</div>
							<div class='card-action center'>
								<button class='waves-effect waves-circle waves-light btn-floating btn-small waves-effect waves-light indigo tooltipped' data-position='bottom' data-tooltip='Excluir Endereço' href=''> 
									<a class='tooltipped' data-position='bottom' data-tooltip='Editar Produto' href='editar.php?id={$produto['id']}'> <i class='material-icons white-text'>edit</i></a>
								</button>
								<button id='btnExcluir" . $produto['id'] . "'class='waves-effect waves-circle waves-light btn-floating btn-small waves-effect waves-light indigo tooltipped' data-position='bottom' data-tooltip='Excluir Produto' href=''> 
									<i class='material-icons white-text'>delete</i>
								</button>
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
	<script src="..\..\assets\js\produtos.js" crossorigin="anonymous"></script>
</body>

</html>