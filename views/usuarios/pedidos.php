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
require_once('../../controllers/produtos.php');
require_once('../../controllers/pedidos.php');
require_once('../utils/ehtml.php');
date_default_timezone_set("America/Sao_Paulo");
$controllerProdutos = new ProdutosController();
$pedidosController = new PedidosController();
if(session_status() <> PHP_SESSION_ACTIVE)
	session_start();
$pedidos = $pedidosController->readPedidos($_SESSION['usuario']['id']);
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
			<?php
				if(count($pedidos)){
					echo "<div class='col s10'>";
					foreach($pedidos as $pedido){
						$icone = $pedido['cabecalho']['cartao_id'] ? 'credit_card' : 'money';
						$totalPedido = $pedidosController->getValor($pedido['cabecalho']['pedido_id'])[0]['valor'];
						$totalPedido = number_format($totalPedido, 2, '.', ',');
						echo "
						<ul class='collapsible'>
							<li>
								<div class='collapsible-header'>
									<i class='material-icons'>$icone</i>Pedido {$pedido['cabecalho']['pedido_id']}
									</div>
								<div class='collapsible-body'>
									<div class='row'>										
									<table class='highlight'>
										<thead>
											<tr>
												<th class='center'>Produto</th>
												<th class='center'>Valor Unitário</th>
												<th class='center'>Quantidade</th>
												<th class='center'>Valor Total</th>
											</tr>
										</thead>
										<tbody>";
								for($i = 0; $i < count($pedido) - 1; $i++){
									$valorUnitario = $pedido[$i]['valor_total']/$pedido[$i]['quantidade'];
									$valorUnitario = number_format($valorUnitario, 2, '.', ',');
									echo "
													<tr>
														<td class='center'>{$pedido[$i]['nome']}</td>
														<td class='center'>R$ {$valorUnitario}</td>
														<td class='center'>{$pedido[$i]['quantidade']}</td>
														<td class='center'>R$ {$pedido[$i]['valor_total']}</td>
													</tr>
									";
								}
								echo "</tbody>
										</table>
										<br>
										<span class='left'><b>Valor Total do Pedido:</b></span>
										<span class='right'><b>{$totalPedido}</b></span>
									</div>
								</div>
							</li>
						</ul>
						";
					}
					echo "</div>";
				}
			?>
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