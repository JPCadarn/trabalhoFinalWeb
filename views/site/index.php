<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Gole Bebidas</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css"  media="screen,projection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="..\..\assets\css\main.css">
	<link rel="icon" href="..\..\assets\images\icone.png">
</head>
  
<?php
	require_once('../../controllers/produtos.php');
	require_once('../../controllers/categorias.php');
	require_once('../../controllers/produtos_destaque.php');
	require_once('../utils/ehtml.php');
	$controllerDestaques = new ProdutosDestaqueController();
	$controllerProdutos = new ProdutosController();
	$destaques = $controllerDestaques->read();
	$maisAcessados = $controllerProdutos->maisAcessados(5);
	$maisVendidos = $controllerProdutos->maisVendidos(5);
	$ehtml = new Ehtml();
?>
<body>
	<?php
		echo "<header>";
			echo $ehtml->navBar('');
		echo "</header>";

		echo "<main>";

		echo "
			<div id='slider' class='slider'>
				<ul class='slides'>";

		foreach($destaques as $destaque){
			$tagSlide = "
				<li>
					<a href='produto.php?id=".$destaque['produto_id']."'>
						<img src='../../assets/images/".$destaque['imagem']."'>
						<div class='caption left-align'>
							<h3 class='grey-text text-darken-3'>".$destaque['nome']."</h3>
							<h5 class='grey-text text-darken-3'>R$ ".$destaque['valor']."</h5>
						</div>
					</a>
				</li>
			";
			echo $tagSlide;
		}
		echo "
				</ul>
				<label class='black-text' for='slider'>Produtos em Destaque</label>
			</div>
		";

		echo "
			<div id='slider' class='slider'>
				<ul class='slides'>";

		foreach($maisVendidos as $maisVendido){
			$maisVendido = $controllerProdutos->read($maisVendido['produto_id'])[0];
			$tagSlide = "
				<li>
					<a href='produto.php?id=".$destaque['produto_id']."'>
						<img src='../../assets/images/".$maisVendido['imagem']."'>
						<div class='caption left-align'>
							<h3 class='grey-text text-darken-3'>".$maisVendido['nome']."</h3>
							<h5 class='grey-text text-darken-3'>R$ ".$maisVendido['valor']."</h5>
						</div>
					</a>
				</li>
			";
			echo $tagSlide;
		}
		echo "
				</ul>
				<label class='black-text' for='slider'>Mais Vendidos</label>
			</div>
		";

		echo "
			<div id='slider' class='slider'>
				<ul class='slides'>";

		foreach($maisAcessados as $maisAcessado){
			$maisAcessado = $controllerProdutos->read($maisAcessado['produto_id'])[0];
			$tagSlide = "
				<li>
					<a href='produto.php?id=".$destaque['produto_id']."'>
						<img src='../../assets/images/".$maisAcessado['imagem']."'>
						<div class='caption left-align'>
							<h3 class='grey-text text-darken-3'>".$maisAcessado['nome']."</h3>
							<h5 class='grey-text text-darken-3'>R$ ".$maisAcessado['valor']."</h5>
						</div>
					</a>
				</li>
			";
			echo $tagSlide;
		}
		echo "
				</ul>
				<label class='black-text' for='slider'>Mais Acessados</label>
			</div>
		";
	?>

	<div class="row valign-wrapper">
		<div class="col s12 m12">
			<div class="card">
				<div class="hoverable card-content">
					<span class="card-title center"><h5>Recebe ofertas e descontos exclusivos</h5></span>
					<div class="row">
						<div class="input-field col s6">
							<i class="material-icons prefix">edit</i>
							<input required id="inputNome" name="dados[nome]" type="text">
							<label for="inputNome">Nome</label>
						</div>
						<div class="input-field col s6">
							<i class="material-icons prefix">email</i>
							<input required id="inputEmail" name="dados[email]" type="text">
							<label for="inputEmail">Email</label>
							<input type="hidden" name="metodo" value="boasVindasCupons">
						</div>
						<div class="right">
							<button class="waves-effect waves-circle waves-light btn-floating btn-large indigo darken-4" type="submit" value="Create">
								<a href="index.php"><i class="large material-icons">check</i></a>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
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