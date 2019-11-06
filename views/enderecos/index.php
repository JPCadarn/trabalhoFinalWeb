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
require_once('../../controllers/enderecos.php');
require_once('../utils/ehtml.php');
date_default_timezone_set("America/Sao_Paulo");
$controllerEnderecos = new EnderecosController();

if (session_status() <> PHP_SESSION_ACTIVE)
	session_start();

if (!isset($_SESSION['usuario']))
	header('Location: ..login/');

$enderecos = $controllerEnderecos->readEnderecos($_SESSION['usuario']['id']);
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
					<a href='../usuarios/pedidos.php' class='breadcrumb'>Conta</a>
					<a href='' class='breadcrumb ativo'>Endereços</a>
					<a href='add.php' class="btn-floating halfway-fab waves-effect waves-light indigo"><span class="btn-breadcrumb">&#43;</span></a>
				</div>
			</div>
		</nav>
		<div class="row">
		<?php
			foreach($enderecos as $endereco){
				$complemento = empty(trim($endereco['complemento'])) ? '' : '-'.$endereco['complemento'];
				echo "
				<div id='endereco".$endereco['id']."' class=' col s12 m6 l4'>
					<div class='card hoverable'>
						<div class='card-content'>
							<p>{$endereco['rua']}, {$endereco['numero']}{$complemento}, {$endereco['bairro']}</p>
							<p>{$endereco['cep']}, {$endereco['cidade']}, {$endereco['estado']}</p>
							<p>{$endereco['referencia']}</p>
							<p>{$endereco['destinatario']}</p>
						</div>
						<div class='card-action'>
							<button class='waves-effect waves-circle waves-light btn-floating btn-small waves-effect waves-light indigo tooltipped' data-position='bottom' data-tooltip='Excluir Endereço' href=''> 
								<a class='tooltipped' data-position='bottom' data-tooltip='Editar Endereço' href='editar.php?id={$endereco['id']}'> <i class='material-icons white-text'>edit</i></a>
							</button>
							<button id='btnExcluir".$endereco['id']."'class='waves-effect waves-circle waves-light btn-floating btn-small waves-effect waves-light indigo tooltipped' data-position='bottom' data-tooltip='Excluir Endereço' href=''> <i class='material-icons white-text'>delete</i></button>
						</div>
					</div>
				</div>";
			}
		?>
		</div>
	</main>
	<?php
		echo $ehtml->footer();
	?>

	<script src="..\..\assets\js\jquery-3.4.1.js"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="..\..\assets\js\main.js"></script>
	<script src="..\..\assets\js\enderecos.js"></script>
</body>

</html>