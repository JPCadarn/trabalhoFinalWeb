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
require_once('../../controllers/usuarios.php');
require_once('../utils/ehtml.php');
require_once('../utils/masks.php');

date_default_timezone_set("America/Sao_Paulo");

$controllerUsuarios = new UsuariosController();

if (session_status() <> PHP_SESSION_ACTIVE)
	session_start();

if (!$_SESSION['usuario']['admin'])
	header('Location: ../site/');
	
$usuarios = $controllerUsuarios->read();
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
					<a href='#' class='breadcrumb ativo'>Pedidos</a>
				</div>
			</div>
		</nav>
		<div class="row">
			<table class="centered highlight responsive-table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>Email</th>
						<th>CPF</th>
						<th>Data de Nascimento</th>
						<th>Data de Criação</th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($usuarios as $usuario){
						echo "<tr>";
							echo "<th class='center'>{$usuario['id']}</th>";
							echo "<th class='center'>{$usuario['nome']}</th>";
							echo "<th class='center'>{$usuario['email']}</th>";
							echo "<th class='center'>{$usuario['cpf']}</th>";
							echo "<th class='center'>{$masks->formatarDataYMD($usuario['data_nascimento'])}</th>";
							echo "<th class='center'>{$masks->formatarDateTimeYMD($usuario['criacao'])}</th>";
						echo "</tr>";
					}
				?>
				</tbody>
			</table>
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