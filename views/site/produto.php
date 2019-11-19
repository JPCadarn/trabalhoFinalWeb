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
	require_once('../../controllers/produtos.php');
	require_once('../../controllers/avaliacaos.php');
	require_once('../../controllers/pedidos.php');
	require_once('../../controllers/log_produtos.php');
	require_once('../utils/ehtml.php');
	date_default_timezone_set("America/Sao_Paulo");
	$controllerProdutos = new ProdutosController();
	$controllerPedidos = new PedidosController();
	$controllerAvaliacaos = new AvaliacaosController();
	$controllerLogs = new LogProdutosController();
	$controllerLogs->create(['id' => $_GET['id'], 'metodo' => 'create']);
	$produto = $controllerProdutos->read($_GET['id'])[0];
	$ehtml = new Ehtml();
	$avaliacoes = $controllerAvaliacaos->readProduto($_GET['id']);
	if(!isset($_SESSION['usuario']['id'])){
		$disabled = 'disabled';
		$usuarioId = 0;
	}else{
		$usuarioId = $_SESSION['usuario']['id'];
		$disabled = '';
	}
	$comprouProduto = $controllerPedidos->usuarioComprouProduto($_GET['id'], $_SESSION['usuario']['id']);
?>
<body>
	<?php
		echo "<header>";
			echo $ehtml->navBar('');
		echo "</header>";
		echo "<main>";
		echo "
			<nav>
				<div class='nav-wrapper indigo darken-4 center'>
				<div class='col s12'>
					<a href='../site/' class='breadcrumb'>Página Inicial</a>
					<a href='categoria.php?id=".$produto['categoria_id']."' class='breadcrumb'>Produtos</a>
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
													<th class='center'>Modalidade</th>
													<th class='center'>Prazo</th>
													<th class='center'>Valor</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th class='center'>Normal</th>
													<th id='prazoNormal' class='center'></th>
													<th id='valorNormal' class='center'></th>
												</tr>
												<tr>
													<th class='center'>Expresso</th>
													<th id='prazoExpresso' class='center'></th>
													<th id='valorExpresso' class='center'></th>
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
		if($comprouProduto){
			echo "<div class='row'>
					<div class='col s12'>
						<div class='card hoverable'>
							<div class='card-content'>
								<span class='card-title center'>Avalie este produto</span>
								<br>
								<span class='col s2 offset-s2 center'>Nota:</span>
								<div class='col offset-s3 s2 center'>
									<input type='hidden' name='dados[nota]' id='inputNota'>
									<i id='estrela1' class='material-icons estrela'>star</i>
									<i id='estrela2' class='material-icons estrela'>star</i>
									<i id='estrela3' class='material-icons estrela'>star</i>
									<i id='estrela4' class='material-icons estrela'>star</i>
									<i id='estrela5' class='material-icons estrela'>star</i>
								</div>
								<div class='row'>
									<form class='col s12'>
										<div class='row'>
											<div class='input-field col s12'>
												<textarea id='textarea' class='materialize-textarea'></textarea>
												<label for='textarea'>Avaliação</label>
											</div>
										</div>
										<a id='btnAvaliar' class='btn-floating btn-large indigo right'>
											<i class='large material-icons'>check</i>
										</a>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>";
		}
		echo "<h3 class='center'>Avaliações</h3>";
		echo "<div id='avaliacaos' class='row'>";
		foreach($avaliacoes as $avaliacao){
			echo "
				<div class='col s12 m4'>
					<div class='card hoverable'>
						<div class='card-content'>
							";
							for($i = 1; $i <= 5; $i++){
								if($i <= $avaliacao['nota'])
									echo "<i class='material-icons indigo-text'>star</i>";
								else
									echo "<i class='material-icons'>star</i>";
							}
							echo "<p>{$avaliacao['texto']}</p>
						</div>
					</div>
				</div>
			";
		}
		echo "</div>";
		echo "</main>";

		echo $ehtml->footer();
	?>

  	<script src="..\..\assets\js\jquery-3.4.1.js"></script>
  	<script src="..\..\assets\js\jquery.mask.js"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="..\..\assets\js\main.js" crossorigin="anonymous"></script>
	<script src="..\..\assets\js\frete.js" crossorigin="anonymous"></script>
	<script src="..\..\assets\js\avaliacao.js" crossorigin="anonymous"></script>
  </body>
</html>