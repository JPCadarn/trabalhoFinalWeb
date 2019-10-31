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
require_once('../../controllers/produtos.php');
require_once('../../controllers/pedidos.php');
require_once('../../controllers/categorias.php');
require_once('../../controllers/produtos_destaque.php');
require_once('../../controllers/usuarios.php');
require_once('../utils/ehtml.php');

date_default_timezone_set("America/Sao_Paulo");

$controllerProdutos = new ProdutosController();
$controllerPedidos = new PedidosController();
$controllerCategorias = new CategoriasController();
$controllerUsuarios = new UsuariosController();
$controllerDestaques = new ProdutosDestaqueController();

if (session_status() <> PHP_SESSION_ACTIVE)
	session_start();

$countPedidos = $controllerPedidos->getCount()[0]['count'];
$countProdutos = $controllerProdutos->getCount()[0]['count'];
$countCategorias = $controllerCategorias->getCount()[0]['count'];
$countDestaques = $controllerDestaques->getCount()[0]['count'];
$countDestaques = $controllerDestaques->getCount()[0]['count'];
$countUsuarios = $controllerUsuarios->getCount()[0]['count'];
$ehtml = new Ehtml();
?>

<body>
	<?php
	echo "<header>";
	echo $ehtml->navBar('');
	echo "</header>";
	?>
	<main>
		<nav>
			<div class='nav-wrapper indigo darken-4 center'>
				<div class='col s12'>
					<a href='../site/' class='breadcrumb'>Página Inicial</a>
					<a href='#' class='breadcrumb ativo'>Painel Administrativo</a>
				</div>
			</div>
		</nav>
		<div class="row">
			<div class="col s12 m4">
				<div class="card hoverable center">
					<div class="card-content">
						<span class="card-title">Produtos</span>
						<p><?php echo $countProdutos ?> produtos cadastrados.</p>
					</div>
					<div class="card-action">
						<a href="../produtos/" class="indigo-text text-lighten-1">Visualizar Produtos</a>
					</div>
				</div>
			</div>
			<div class="col s12 m4">
				<div class="card hoverable center">
					<div class="card-content">
						<span class="card-title">Pedidos</span>
						<p><?php echo $countPedidos ?> pedidos realizados.</p>
					</div>
					<div class="card-action">
						<a href="pedidos.php" class="indigo-text text-lighten-1">Visualizar Pedidos</a>
					</div>
				</div>
			</div>
			<div class="col s12 m4">
				<div class="card hoverable center">
					<div class="card-content">
						<span class="card-title">Categorias</span>
						<p><?php echo $countCategorias ?> categorias cadastradas.</p>
					</div>
					<div class="card-action">
						<a href="../categorias/" class="indigo-text text-lighten-1">Visualizar Categorias</a>
					</div>
				</div>
			</div>
			<div class="col s12 m4">
				<div class="card hoverable center">
					<div class="card-content">
						<span class="card-title">Produtos em Destaque</span>
						<p><?php echo $countDestaques ?> produtos em destaque.</p>
					</div>
					<div class="card-action">
						<a href="../destaques/" class="indigo-text text-lighten-1">Visualizar Destaques</a>
					</div>
				</div>
			</div>
			<div class="col s12 m4">
				<div class="card hoverable center">
					<div class="card-content">
						<span class="card-title">Usuários</span>
						<p><?php echo $countUsuarios ?> usuários cadastrados.</p>
					</div>
					<div class="card-action">
						<a href="usuarios.php" class="indigo-text text-lighten-1">Visualizar Usuários</a>
					</div>
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
</body>

</html>