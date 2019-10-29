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
require_once('../../controllers/usuarios.php');
require_once('../utils/ehtml.php');
date_default_timezone_set("America/Sao_Paulo");
$controllerUsuarios = new UsuariosController();

if (session_status() <> PHP_SESSION_ACTIVE)
	session_start();

if (!isset($_SESSION['usuario']))
	header('Location: ..login/');

$dadosUsuario = $controllerUsuarios->read($_SESSION['usuario']['id'])[0];
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
					<a href='index.php' class='breadcrumb'>Página Inicial</a>
					<a href='' class='breadcrumb'>Conta</a>
					<a href='' class='breadcrumb'>Meus Dados</a>
				</div>
			</div>
		</nav>
		<div class="row">
			<div class="col s2">
				<ul class="collection">
					<li class="collection-item center"><a class="black-text" href='pedidos.php'>Pedidos</a></li>
					<li class="collection-item center"><a class="black-text" href='edit.php'>Meus Dados</a></li>
					<li class="collection-item center"><a class="black-text" href='../enderecos/'>Endereços</a></li>
					<li class="collection-item center"><a class="black-text" href='../cartaos/'>Cartões</a></li>
				</ul>
			</div>
			<div class="col s9">
				<br>
				<div class="row">
					<form action="..\..\controllers\usuarios.php" method="post" class="col s12">
						<div class="row center">
							<div class="input-field col s12">
								<i class="material-icons prefix">email</i>
								<input required id="inputEmail" value="<?php echo $dadosUsuario['email'] ?>" name="dados[email]" type="text">
								<label for="inputEmail">Email</label>
								<input type="hidden" name="metodo" value="edit">
								<input type="hidden" name="link_retorno" value="../views/usuarios/pedidos.php">
								<input type="hidden" name="id" value="<?php echo $dadosUsuario['id'] ?>">
							</div>
						</div>
						<div class="row center">
							<div class="input-field col s12">
								<i class="material-icons prefix">edit</i>
								<input required id="inputNome" name="dados[nome]" type="text" value="<?php echo $dadosUsuario['nome'] ?>">
								<label for="inputNome">Nome</label>
							</div>
						</div>
						<div class="row center">
							<div class="input-field col s12">
								<i class="material-icons prefix">person</i>
								<input required id="inputCpf" name="dados[cpf]" type="text" value="<?php echo $dadosUsuario['cpf'] ?>">
								<label for="inputCpf">CPF</label>
							</div>
						</div>
						<div class="row center">
							<div class="input-field col s12">
								<i class="material-icons prefix">date_range</i>
								<input id="nascimento" name="dados[data_nascimento]" type="date" value="<?php echo $dadosUsuario['data_nascimento'] ?>">
								<label for="nascimento">Data de Nascimento</label>
							</div>
						</div>
						<div class="row center">
							<div class="input-field col s12">
								<i class="material-icons prefix">vpn_key</i>
								<input required id="inputSenhaAntiga" type="password">
								<label for="inputSenhaAntiga">Senha Atual</label>
								<span class="helper-text" data-error="Senha Inválida"></span>
							</div>
						</div>
						<div class="row center">
							<div class="input-field col s12">
								<i class="material-icons prefix">vpn_key</i>
								<input required id="inputSenha" name="dados[senha]" type="password">
								<label for="inputSenha">Nova Senha</label>
							</div>
						</div>
						<div class="row center">
							<div class="input-field col s12">
								<i class="material-icons prefix">vpn_key</i>
								<input required id="inputConfirmaSenha" type="password">
								<label for="inputConfirmaSenha">Confirme sua Nova Senha</label>
							</div>
						</div>
						<div class="right">
							<button disabled id="btnSubmit" type="submit" class="btn-floating btn-large indigo darken-4">
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