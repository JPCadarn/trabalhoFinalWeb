<!DOCTYPE html>
<html lang="pt-br">
<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css"  media="screen,projection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="..\..\assets\css\main.css">
</head>
  
<?php
	require_once('../../controllers/produtos.php');
	require_once('../../controllers/log_produtos.php');
	require_once('../utils/ehtml.php');
	date_default_timezone_set("America/Sao_Paulo");
	$controllerProdutos = new ProdutosController();
	$controllerLogs = new LogProdutosController();
	$controllerLogs->create(['id' => $_GET['id'], 'metodo' => 'create']);
	$produto = $controllerProdutos->read($_GET['id'])[0];
	$ehtml = new Ehtml();
	if(!isset($_SESSION['usuario']['id'])){
		$disabled = 'disabled';
		$usuarioId = 0;
	}else{
		$usuarioId = $_SESSION['usuario']['id'];
		$disabled = '';
	}
?>
<body>
	<?php
		echo "<header>";
			echo $ehtml->navBar('');
		echo "</header>";
		echo "<main>";
			$linkCategoria = trim($_SERVER['HTTP_REFERER']);
		echo "
			<nav>
				<div class='nav-wrapper indigo darken-4 center'>
				<div class='col s12'>
					<a href='../site/' class='breadcrumb'>Página Inicial</a>
					<a href='$linkCategoria' class='breadcrumb'>Produtos</a>
					<span class='breadcrumb ativo'>{$produto['nome']}</span>
				</div>
				</div>
			</nav>
		";

		echo "
			<div class='row'>
				<div class='col s12 m12'>
					<form action='..\..\controllers\carrinhos.php' method='POST'>
						<div class='card horizontal hoverable'>
							<div class='card-image'>
								<img src='../../assets/images/".$produto['imagem']."'>
							</div>
							<div class='card-stacked'>
								<h2 class='header center'>{$produto['nome']}</h2>
								<div class='card-content'>
									<p>{$produto['descricao']}</p>
								</div>
								<input type='hidden' name='dados[produto_id]' value='{$_GET['id']}'>
								<input type='hidden' name='dados[usuario_id]' value='{$usuarioId}'>
								<input type='hidden' name='metodo' value='create'>
								<div class='card-action'>
									<div class='input-field col s12 m8'>
										<i class='material-icons prefix'>my_location</i>
										<input required id='inputCep' type='text'>
										<label for='inputCep'>Cep</label>
									</div>
									<div class='input-field col s12 m3 offset-m1'>
										<span id='btnFrete' class='indigo darken-4 col s12 btn waves-effect waves-light'>
											<i class='material-icons left'>local_shipping</i>Calcular Frete
										</span>
									</div>
									<div id='valoresFrete' class='col s12 oculto'>
										<table class='highlight'>
											<thead>
												<tr>
													<th>Modalidade</th>
													<th>Prazo</th>
													<th>Valor</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th>PAC</th>
													<th id='prazoPAC'></th>
													<th id='valorPAC'></th>
												</tr>
												<tr>
													<th>Sedex</th>
													<th id='prazoSedex'></th>
													<th id='valorSedex'></th>
												</tr>
											</tbody>
										</table>
										<br>
										<br>
									</div>
									<button $disabled type='submit' class='indigo darken-4 col s12 btn waves-effect waves-light'>
										<i class='material-icons left'>shopping_cart</i>Comprar
									</button>
								</div>
						</div>
					</form>
				</div>
			</div>";
		echo "</main>";

		echo $ehtml->footer();
	?>

  	<script src="..\..\assets\js\jquery-3.4.1.js"></script>
  	<script src="..\..\assets\js\jquery.mask.js"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="..\..\assets\js\main.js" crossorigin="anonymous"></script>
	<script src="..\..\assets\js\frete.js" crossorigin="anonymous"></script>
  </body>
</html>