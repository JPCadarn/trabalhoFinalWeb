<!DOCTYPE html>
<html lang="pt-br">
<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css"  media="screen,projection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="..\..\assets\css\main.css">
	<link rel="icon" href="..\..\assets\images\icone.png">
</head>
  
<?php
	require_once('../../controllers/usuarios.php');
	require_once('../../controllers/usuarios.php');
	require_once('../utils/ehtml.php');
	require_once('../utils/sessao.php');
	$controller = new UsuariosController();
	$classeSessao = new Sessao();
	$ehtml = new Ehtml();
	if(isset($_SESSION['usuario']))
		header('Location: ../site');
?>
<body>
	<header>
	<?php
		if(!isset($_SESSION))
			$classeSessao->iniciarSessao();
		echo $ehtml->navBar('');
		$link_retorno = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../views/site/';
	?>
	</header>
	
	<div class="section"></div>
  	<main>
    	<center>
      		<div class="section"></div>

      		<h5 class="black-text">Faça login na sua conta</h5>
      		<div class="section"></div>

      		<div class="container">
    			<div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

					<form class="col s12" action="..\..\controllers\usuarios.php" method="post">
						<div class='row'>
							<div class='col s12'></div>
						</div>

						<div class='row'>
							<div class='input-field col s12'>
								<i class="material-icons prefix">email</i>
								<input class='validate' type='text' name='email' id='email' />
								<input type='hidden' name='metodo' value="login" />
								<input type='hidden' name='dados[link_retorno]' value="<?php echo $link_retorno?>" />
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
								<a class='indigo-text' href='#!'><b>Esqueceu sua senha?</b></a>
							</label>
						</div>

						<br />
						<center>
							<div class='row'>
								<button name='btnCadastrar' tabindex="-1" data-target="addModal" class='indigo darken-1 modal-trigger col s6 btn btn-large waves-effect waves-light'>Cadastrar</button>
								<button type='submit' name='btnLogin' class='indigo darken-1 col s6 btn btn-large waves-effect waves-light'>Login</button>
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
								<input required id="inputEmail" maxlength="60" name="dados[email]" type="text">
								<label for="inputEmail">Email</label>
								<input type="hidden" name="metodo" value="Create">
							</div>
						</div>
						<div class="row center">
							<div class="input-field col s12">
								<i class="material-icons prefix">edit</i>
								<input required id="inputNome" maxlength="100" name="dados[nome]" type="text">
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
								<label for="inputConfirmaSenha">Confirme sua Senha</label>
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
		<?php
			if(isset($_GET['erro'])){
				switch ($_GET['erro']) {
					case 2:
						$mensagemErro = 'Usuário não encontrado';
						break;
					case 3:
						$mensagemErro = 'A senha informada está incorreta';
						break;
					default:
						$mensagemErro = 'Ocorreu um erro ao realizar o login';
				}
				echo "
					<div id='modalErro' class='modal'>
						<div class='modal-content center'>
							<h4>Erro ao realizar login</h4>
							<p>$mensagemErro</p>
						</div>
						<div class='modal-footer center'>
							<a href='#!' class='btn-floating red modal-close waves-effect waves-light'><i class='material-icons'>close</i></a>
						</div>
					</div>
				";
			}
		?>
	</main>
	  
	<?php
		echo $ehtml->footer(); 
	?>

  	<script src="..\..\assets\js\jquery-3.4.1.js"></script>
  	<script src="..\..\assets\js\jquery.mask.js"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="..\..\assets\js\main.js" crossorigin="anonymous"></script>
	<script src="..\..\assets\js\usuarios.js" crossorigin="anonymous"></script>
	<script src="..\..\assets\js\masks\usuarios.js" crossorigin="anonymous"></script>
  </body>
</html>