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
require_once('../../controllers/enderecos.php');
require_once('../utils/ehtml.php');
$controller = new EnderecosController();
$endereco = $controller->read($_GET['id'])[0];
date_default_timezone_set("America/Sao_Paulo");

if (session_status() <> PHP_SESSION_ACTIVE)
	session_start();

if (!isset($_SESSION['usuario']))
	header('Location: ..login/');

$ehtml = new Ehtml();
?>

<body>
	<?php
	echo "<header>";
	echo $ehtml->navBar('Minha Conta');
	echo "</header>";
	?>
	<main>
		<nav>
			<div class='nav-wrapper indigo darken-4 center'>
				<div class='col s12'>
					<a href='../site/' class='breadcrumb'>Página Inicial</a>
					<a href='#' class='breadcrumb'>Conta</a>
					<a href='index.php' class='breadcrumb'>Endereços</a>
					<a href='#' class='breadcrumb ativo'>Alterar</a>
				</div>
			</div>
		</nav>
		<div class="row">
			<div class="col s12">
				<br>
				<div class="row">
					<form action="..\..\controllers\enderecos.php" method="post" class="col s12">
						<input type="hidden" name="metodo" value="edit">
						<input type="hidden" name="id" value="<?php echo $endereco['id']?>">
						<input type="hidden" name="dados[usuario_id]" value="<?php echo $_SESSION['usuario']['id'] ?>">
						<div class="row center">
						<div class="input-field col s12">
								<i class="material-icons prefix">person</i>
								<input required id="inputDestinatario" value="<?php echo $endereco['destinatario']?>" name="dados[destinatario]" type="text">
								<label for="inputDestinatario">Destinatário</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix">my_location</i>
								<input required id="inputRua" value="<?php echo $endereco['rua']?>" name="dados[rua]" type="text">
								<label for="inputRua">Rua</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix">filter_1</i>
								<input required id="inputNumero" value="<?php echo $endereco['numero']?>" name="dados[numero]" type="number">
								<label for="inputNumero">Número</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix">assignment</i>
								<input id="inputComplemento" value="<?php echo $endereco['complemento']?>" name="dados[complemento]" type="text">
								<label for="inputComplemento">Complemento</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix">home</i>
								<input required id="inputBairro" value="<?php echo $endereco['bairro']?>" name="dados[bairro]" type="text">
								<label for="inputBairro">Bairro</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix">local_post_office</i>
								<input required id="inputCep" value="<?php echo $endereco['cep']?>" name="dados[cep]" type="text">
								<label for="inputCep">CEP</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix">location_city</i>
								<input required id="inputCidade" value="<?php echo $endereco['cidade']?>" name="dados[cidade]" type="text">
								<label for="inputCidade">Cidade</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix">map</i>
								<input required id="inputEstado" value="<?php echo $endereco['estado']?>" name="dados[estado]" type="text">
								<label for="inputEstado">Estado</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix">more</i>
								<input id="inputReferencia" value="<?php echo $endereco['referencia']?>" name="dados[referencia]" type="text">
								<label for="inputReferencia">Referência</label>
							</div>
						</div>
						<div class="right">
							<button id="btnSubmit" type="submit" class="btn-floating btn-large indigo darken-4">
								<i class="large material-icons">check</i>
							</button>
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
	<script src="..\..\assets\js\main.js"></script>
	<script src="..\..\assets\js\usuarios.js"></script>
</body>

</html>