<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Destaques - Gole Bebidas</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css" media="screen,projection" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="..\..\assets\css\main.css">
	<link rel="icon" href="..\..\assets\images\icone.png">
</head>

<?php
if (session_status() <> PHP_SESSION_ACTIVE)
	session_start();

if (!$_SESSION['usuario']['admin'])
	header('Location: ../site/');

require_once('../../controllers/produtos_destaque.php');
require_once('../../controllers/produtos.php');
require_once('../utils/ehtml.php');
$destaquesController = new ProdutosDestaqueController();
$destaques = $destaquesController->read();
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
					<a href='' class='breadcrumb ativo'>Itens em Destaque</a>
					<a data-target="addModal" class="modal-trigger btn-floating halfway-fab waves-effect waves-light indigo"><span class="btn-breadcrumb">&#43;</span></a>
				</div>
			</div>
		</nav>
		<div class="row">
			<?php
			foreach ($destaques as $destaque) {
				echo "
					<div id='destaque" . $destaque['id'] . "' class='col s12 m4'>
						<div class='card hoverable'>
							<div class='card-image'>
								<img src='..\..\assets\images\\" . $destaque['imagem'] . "'>
							</div>
							<div class='card-content center'>
								<span class='card-title black-text'>{$destaque['nome']}</span>
								<p>R$ {$destaque['valor']}</p>
							</div>
							<div class='card-action center'>
								<button id='btnExcluir" . $destaque['id'] . "'class='waves-effect waves-circle waves-light btn-floating btn-small waves-effect waves-light indigo tooltipped' data-position='bottom' data-tooltip='Excluir Endereço' href=''> 
									<i class='material-icons white-text'>delete</i>
								</button>
							</div>
						</div>
					</div>	
				";
			}
			?>
		</div>

		<div id="addModal" class="modal bottom-sheet">
			<div class="modal-title">
				<h4 class="center">Adicionar Categoria</h4>
			</div>
			<div class="modal-content">
				<div class="row">
					<form action="..\..\controllers\produtos_destaque.php" method="post" class="col s12">
						<div class="row center">
							<div class="input-field col s12">
								<i class="material-icons prefix">reorder</i>
								<input id="inputOrdem" name="dados[ordem]" type="number">
								<label for="inputOrdem">Ordem</label>
								<input type="hidden" name="metodo" value="Create">
							</div>
							<?php
							echo $ehtml->selectProdutos();
							?>
						</div>
						<div class="fixed-action-btn">
							<div class="fixed-action-btn">
								<button class="waves-effect waves-circle waves-light btn-floating btn-large indigo darken-4" type="submit" value="Create">
									<i class="large material-icons">check</i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</main>

	<?php
	echo $ehtml->footer();
	?>

	<script src="..\..\assets\js\jquery-3.4.1.js"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="..\..\assets\js\main.js" crossorigin="anonymous"></script>
	<script src="..\..\assets\js\destaques.js" crossorigin="anonymous"></script>
</body>

</html>