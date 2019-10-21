<!DOCTYPE html>
<html lang="pt-br">
<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css"  media="screen,projection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="..\..\assets\css\main.css">
</head>
  
<?php
	require_once('../../controllers/logins.php');
	require_once('../utils/ehtml.php');
	$controller = new LoginsController();
	$ehtml = new Ehtml();
?>
<body>
	<?php
		echo $ehtml->navBar('Login');
	?>
	
	<div class="section"></div>
  	<main>
    	<center>
      		<div class="section"></div>

      		<h5 class="black-text">Faça login na sua conta</h5>
      		<div class="section"></div>

      		<div class="container">
    			<div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

					<form class="col s12" action="..\..\controllers\logins.php" method="post">
						<div class='row'>
							<div class='col s12'></div>
						</div>

						<div class='row'>
							<div class='input-field col s12'>
								<i class="material-icons prefix">email</i>
								<input class='validate' type='email' name='email' id='email' />
								<input type='hidden' name='metodo' value="read" />
								<label for='email'>Email</label>
							</div>
						</div>

						<div class='row'>
							<div class='input-field col s12'>
								<i class="material-icons prefix">vpn_key</i>
								<input class='validate' type='password' name='senha' id='senha' />
								<label for='senha'>Senha</label>
							</div>
							<label style='float: right;'>
								<a class='pink-text' href='#!'><b>Esqueceu sua senha?</b></a>
							</label>
						</div>

						<br />
						<center>
							<div class='row'>
								<button name='btnCadastrar' data-target="addModal" class='modal-trigger col s6 btn btn-large waves-effect'>Cadastrar</button>
								<button type='submit' name='btnLogin' class='col s6 btn btn-large waves-effect'>Login</button>
							</div>
						</center>
					</form>
       			</div>
      		</div>
    	</center>

		<div id="addModal" class="modal valign-wrapper">
			<div class="modal-title">
				<h4 class="center">Adicionar Categoria</h4>
			</div>
			<div class="modal-content">
				<div class="row">
					<form action="..\..\controllers\usuarios.php" method="post" class="col s12">
						<div class="row center">
							<div class="input-field col s12">
								<i class="material-icons prefix">email</i>
								<input required id="inputEmail" name="dados[email]" type="text">
								<label for="inputEmail">Email</label>
								<input type="hidden" name="metodo" value="Create">
							</div>
						</div>
						<div class="row center">
							<div class="input-field col s12">
								<i class="material-icons prefix">edit</i>
								<input required id="inputNome" name="dados[nome]" type="text">
								<label for="inputNome">Nome</label>
							</div>
						</div>
						<div class="row center">
							<div class="input-field col s12">
								<i class="material-icons prefix">person</i>
								<input required id="inputCpf" name="dados[cpf]" type="text">
								<label for="inputCpf">CPF</label>
							</div>
						</div>
						<div class="row center">
							<div class="input-field col s12">
								<i class="material-icons prefix">vpn_key</i>
								<input required id="inputSenha" name="dados[senha]" type="password">
								<label for="inputSenha">Senha</label>
							</div>
						</div>
						<div class="row center">
							<div class="input-field col s12">
								<i class="material-icons prefix">vpn_key</i>
								<input required id="inputConfirmaSenha" type="password">
								<label for="inputSenha">Confirme sua Senha</label>
							</div>
						</div>
						<div class="row center">
							<div class="input-field col s12">
								<i class="material-icons prefix">date_range</i>
								<input id="nascimento" name="dados[data_nascimento]" type="date">
								<label for="nascimento">Data de Nascimento</label>
							</div>
						</div>
						<div class="right">
							<button class="btn-floating btn-large indigo darken-4" type="submit" value="Create">
								<i class="large material-icons">check</i>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>

    	<div class="section"></div>
    	<div class="section"></div>
  	</main>

  	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="https://kit.fontawesome.com/70c1a7f591.js" crossorigin="anonymous"></script>
	<script src="..\..\assets\js\main.js" crossorigin="anonymous"></script>
  </body>
</html>