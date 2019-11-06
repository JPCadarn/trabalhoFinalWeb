<!DOCTYPE html>
<html lang="pt-br">

<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css" media="screen,projection" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="..\..\assets\css\main.css">
	<link rel="icon" href="..\..\assets\images\icone.png">
</head>

<?php
require_once('../../controllers/produtos.php');
require_once('../../controllers/usuarios.php');
require_once('../utils/ehtml.php');
require_once('../utils/masks.php');

date_default_timezone_set("America/Sao_Paulo");

$controllerProdutos = new ProdutosController();
$controllerUsuarios = new UsuariosController();

if (session_status() <> PHP_SESSION_ACTIVE)
	session_start();

if (!$_SESSION['usuario']['admin'])
	header('Location: ../site/');

$maisAcessados = $controllerProdutos->maisAcessados();
$maisVendidos = $controllerProdutos->maisVendidos();
$usuariosAcessos = $controllerUsuarios->getAcessos();
$ehtml = new Ehtml();
$masks = new Masks();
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
					<a href='index.php' class='breadcrumb'>Painel Administrativo</a>
					<a href='#' class='breadcrumb ativo'>Logs</a>
				</div>
			</div>
		</nav>
		<div class="row">
			<div class="col s12 m3 center">
				<p>Acessos a Produtos</p>
				<table class="centered highlight responsive-table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nome</th>
							<th>Número de Acessos</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($maisAcessados as $maisAcessado) {
							echo "<tr>";
							echo "<th class='center'>{$maisAcessado['produto_id']}</th>";
							echo "<th class='center'>{$maisAcessado['nome']}</th>";
							echo "<th class='center'>{$maisAcessado['count']}</th>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
			<div class="col s12 m3 offset-m1 center">
				<p>Vendas de Produtos</p>
				<table class="centered highlight responsive-table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nome</th>
							<th>Número de Vendas</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($maisVendidos as $maisVendido) {
							echo "<tr>";
							echo "<th class='center'>{$maisVendido['produto_id']}</th>";
							echo "<th class='center'>{$maisVendido['nome']}</th>";
							echo "<th class='center'>{$maisVendido['count']}</th>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
			<div class="col s12 m3 offset-m1 center">
				<p>Acessos de Usuários</p>
				<table class="centered highlight responsive-table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Email</th>
							<th>Data/Hora</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($usuariosAcessos as $acesso) {
							echo "<tr>";
							echo "<th class='center'>{$acesso['usuario_id']}</th>";
							echo "<th class='center'>{$acesso['email']}</th>";
							echo "<th class='center'>{$masks->formatarDataYMD($acesso['data'])} {$acesso['hora']}</th>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</main>
	<?php

	echo $ehtml->footer();
	?>

	<script src="..\..\assets\js\jquery-3.4.1.js"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="..\..\assets\js\main.js" crossorigin="anonymous"></script>
	<script src="..\..\assets\js\pedidosAdm.js" crossorigin="anonymous"></script>
</body>

</html>