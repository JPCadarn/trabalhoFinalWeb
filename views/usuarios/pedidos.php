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
					<li class="collection-item">Pedidos</li>
					<li class="collection-item">Meus Dados</li>
					<li class="collection-item">Endereços</li>
					<li class="collection-item">Cartões</li>
				</ul>
			</div>
			<?php
				if(count($pedidos)){
					echo "<div class='col s10'>";
					foreach($pedidos as $pedido){
						$icone = $pedido['cabecalho']['cartao_id'] ? 'credit_card' : 'money';
						echo "
						<ul class='collapsible'>
							<li>
								<div class='collapsible-header'>
									<i class='material-icons'>$icone</i>Pedido {$pedido['cabecalho']['pedido_id']}
									</div>
								<div class='collapsible-body'>
									";
								for($i = 0; $i < count($pedido) - 1; $i++){
									echo "
										<div class='row'>
											<span>{$pedido[$i]['nome']}</span>
										</div>
									";
								}
								echo "</div>
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

	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="..\..\assets\js\main.js" crossorigin="anonymous"></script>
</body>

</html>