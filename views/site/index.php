<!DOCTYPE html>
<html lang="pt-br">
<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css"  media="screen,projection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="..\..\assets\css\main.css">
</head>
  
<?php
	require_once('../../controllers/produtos.php');
	require_once('../../controllers/categorias.php');
	require_once('../../controllers/produtos_destaque.php');
	require_once('../utils/ehtml.php');
	$controllerDestaques = new ProdutosDestaqueController();
	$destaques = $controllerDestaques->read();
	$ehtml = new Ehtml();
?>
<body>
	<?php
		echo $ehtml->navBar('');

		echo "
			<div id='slider' class='slider'>
				<ul class='slides'>";

		foreach($destaques as $destaque){
			$tagSlide = "
				<li>
					<img src='../../assets/images/".$destaque['imagem']."'>
					<div class='caption left-align'>
						<h3 class='grey-text text-darken-3'>".$destaque['nome']."</h3>
						<h5 class='grey-text text-darken-3'>R$ ".$destaque['valor']."</h5>
					</div>
				</li>
			";
			echo $tagSlide;
		}
		echo "
				</ul>
				<label class='black-text' for='slider'>Produtos em Destaque</label>
			</div>
		";
	?>

	<div class="row valign-wrapper">
		<div class="col s12 m12">
			<div class="card">
				<div class="hoverable card-content">
					<span class="card-title center"><h5>Recebe ofertas e descontos exclusivos</h5></span>
					<div class="row">
						<form>
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
								<button class="btn-floating btn-large indigo darken-4" type="submit" value="Create">
									<i class="large material-icons">check</i>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
		echo $ehtml->footer();
	?>

  	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="https://kit.fontawesome.com/70c1a7f591.js" crossorigin="anonymous"></script>
	<script src="..\..\assets\js\main.js" crossorigin="anonymous"></script>
  </body>
</html>