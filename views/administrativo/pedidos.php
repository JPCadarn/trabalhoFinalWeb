<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Painel Adminstrativo - Gole Bebidas</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css" media="screen,projection" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="..\..\assets\css\main.css">
	<link rel="icon" href="..\..\assets\images\icone.png">
</head>

<?php
require_once('../../controllers/pedidos.php');
require_once('../utils/ehtml.php');
require_once('../utils/masks.php');

date_default_timezone_set("America/Sao_Paulo");

$controllerPedidos = new PedidosController();

if (session_status() <> PHP_SESSION_ACTIVE)
	session_start();

if (!$_SESSION['usuario']['admin'])
	header('Location: ../site/');
	
$pedidos = $controllerPedidos->readPedidosDetalhado();
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
						<th>Cliente</th>
						<th>Data</th>
						<th>Hora</th>
						<th>Pagamento</th>
						<th>Valor</th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($pedidos as $pedido){
						$pagamento = '';
						$infoCartao = '';
						if(!$pedido['cartao_id']){
							$pagamento = 'Boleto';
						}elseif($pedido['debito_credito'] == 'C'){
							$infoCartao = "**** **** **** {$pedido['ultimos_quatro']} ".PHP_EOL." {$pedido['parcelas']} parcela(s)";
							$pagamento = "Crédito <i id='cartao".$pedido['cartao_id']."' title='{$infoCartao}' class='material-icons'>credit_card</i>";
						}elseif($pedido['debito_credito'] == 'D'){
							$infoCartao = "**** **** **** {$pedido['ultimos_quatro']} ".PHP_EOL." {$pedido['parcelas']} parcela(s)";
							$pagamento = "Débito <i id='cartao".$pedido['cartao_id']."' title='{$infoCartao}' class='material-icons'>credit_card</i>";
						}

						echo "<tr>";
							echo "<th class='center'>{$pedido['id']}</th>";
							echo "<th class='center'>{$pedido['nome']}</th>";
							echo "<th class='center'>{$masks->formatarDataYMD($pedido['data'])}</th>";
							echo "<th class='center'>{$pedido['hora']}</th>";
							echo "<th class='center'>{$pagamento}</th>";
							echo "<th class='center'>R\$ {$pedido['valor']}</th>";
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
	<script src="..\..\assets\js\pedidosAdm.js" crossorigin="anonymous"></script>
</body>

</html>