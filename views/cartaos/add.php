<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Cartões - Gole Bebidas</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css" media="screen,projection" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="..\..\assets\css\main.css">
	<link rel="icon" href="..\..\assets\images\icone.png">
</head>

<?php
require_once('../utils/ehtml.php');
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
	echo $ehtml->navBar('');
	echo "</header>";
	?>
	<main>
		<nav>
			<div class='nav-wrapper indigo darken-4 center'>
				<div class='col s12'>
					<a href='../site/' class='breadcrumb'>Página Inicial</a>
					<a href='#' class='breadcrumb'>Conta</a>
					<a href='index.php' class='breadcrumb'>Cartões</a>
					<a href='#' class='breadcrumb ativo'>Adicionar</a>
				</div>
			</div>
		</nav>
		<div class="row">
			<div class="col s12">
				<br>
				<div class="row">
					<form action="..\..\controllers\cartaos.php" method="post" class="col s12">
						<input type="hidden" name="metodo" value="create">
						<input type="hidden" name="dados[usuario_id]" value="<?php echo $_SESSION['usuario']['id'] ?>">
						<div class="row center">
							<div class="input-field col s12">
								<i class="material-icons prefix">credit_card</i>
								<input required id="inputNumero" name="dados[numero]" type="text">
								<label for="inputNumero">Número do Cartão</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix">person</i>
								<input required id="inputNome" name="dados[nome_impresso]" type="text">
								<label for="inputNome">Nome Impresso do Cartão</label>
							</div>
							<div class="input-field col s6 m4">
								<i class="material-icons prefix">date_range</i>
								<input select-years="15" required id="inputValidade" name="dados[validade]" type="text" class="datepicker">
								<label for="inputValidade">Validade</label>
							</div>
							<div class="input-field col s6 m4">
								<i class="material-icons prefix">vpn_key</i>
								<input required id="inputCodigo" maxlength="3" name="dados[codigo_seguranca]" type="number">
								<label for="inputCodigo">Código de Segurança</label>
							</div>
							<div class="input-field col s12 m4">
								<select name="dados[debito_credito]">
									<option value="" disabled selected>Selecione o Tipo</option>
									<option value="D">Débito</option>
									<option value="C">Crédito</option>
								</select>
								<label>Tipo do Cartão</label>
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
	<script src="..\..\assets\js\jquery.mask.js"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="..\..\assets\js\main.js"></script>
	<script src="..\..\assets\js\masks\cartaos.js"></script>
</body>

</html>