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
require_once('../../controllers/cartaos.php');
require_once('../utils/ehtml.php');
date_default_timezone_set("America/Sao_Paulo");
$controllerCartaos = new CartaosController();

if (session_status() <> PHP_SESSION_ACTIVE)
	session_start();

if (!isset($_SESSION['usuario']))
	header('Location: ..login/');

$cartaos = $controllerCartaos->readCartaos($_SESSION['usuario']['id']);
$ehtml = new Ehtml();
?>

<body>
	<?php
	echo "<header>";
	echo $ehtml->navBar('Endereços');
	echo "</header>";
	?>
	<main>
		<nav>
			<div class='nav-wrapper indigo darken-4 center'>
				<div class='col s12'>
					<a href='../site/' class='breadcrumb'>Página Inicial</a>
					<a href='../usuarios/pedidos.php' class='breadcrumb'>Conta</a>
					<a href='#' class='breadcrumb ativo'>Cartões</a>
					<a href='add.php' class="btn-floating halfway-fab waves-effect waves-light indigo"><span class="btn-breadcrumb">&#43;</span></a>
				</div>
			</div>
		</nav>
		<div class="row">
		<?php
			foreach($cartaos as $cartao){
				$ultimosQuatro = '**** **** **** '.$cartao['ultimos_quatro'];

				if($cartao['debito_credito'] == 'C')
					$tipo = 'Crédito';
				else
					$tipo = 'Débito';

				echo "
				<div id='cartao".$cartao['id']."' class=' col s12 m6 l4'>
					<div class='card hoverable'>
						<div class='card-content'>
							<p>{$ultimosQuatro}</p>
							<p>{$cartao['nome_impresso']}</p>
							<p>Valido até {$cartao['validade']}</p>
							<p>{$tipo}</p>
						</div>
						<div class='card-action'>
							<button id='btnExcluir".$cartao['id']."'
								class='waves-effect waves-circle waves-light btn-floating btn-small waves-effect waves-light indigo tooltipped' 
								data-position='bottom' data-tooltip='Excluir Cartão' href=''> 
								<i class='material-icons white-text'>delete</i>
							</button>
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
	<script src="..\..\assets\js\cartaos.js"></script>
</body>

</html>